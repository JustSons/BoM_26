<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Applicant;
use App\Models\ApplicantFile;
use App\Models\Division;
use App\Models\Motivation;
use App\Models\Schedule;
use App\Models\AdminSchedule;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduleNotif;
use App\Jobs\SendMail;
use App\Mail\NoScheduleAvailable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ApplicantController extends Controller
{
    public function homepage()
    {
        return view('homepage.homepage');
    }
    public function index()
    {
        $title = 'Biodata';
        $data = [
            'nrp'       => Session::get('nrp'),
            'name'      => Session::get('name'),
            'angkatan'  => Session::get('angkatan'),
        ];

        $nrp = Session::get('nrp');
        $isExist = Applicant::where('nrp', $nrp)->exists();
        $applicant = Applicant::where('nrp', $nrp)->first();
        $currentStep = 1; // Default untuk pengguna baru
        if ($applicant) {
            // phase 0 -> selesai, aktif di step 2 (Berkas)
            // phase 1 -> selesai, aktif di step 3 (Jadwal)
            // phase 2 -> selesai, semua tuntas (kita sebut step 4)
            $currentStep = $applicant->phase + 2;
        }
        if($applicant){
            $data['prodi'] = $applicant->prodi;
            $data['line_id'] = $applicant->line_id;
            $data['no_hp'] = $applicant->no_hp;
            $data['ipk'] = $applicant->ipk;
            $data['jenis_kelamin'] = $applicant->jenis_kelamin;
            $data['instagram'] = $applicant->instagram;
            $data['motivasi'] = $applicant->motivasi;
            $data['komitmen'] = $applicant->komitmen;
            $data['kelebihan'] = $applicant->kelebihan;
            $data['kekurangan'] = $applicant->kekurangan;
            $data['pengalaman'] = $applicant->pengalaman;
            $data['division_choice1'] = Division::where('id', $applicant->division_choice1)->first()->slug;
            $data['division_choice2'] = Division::where('id', $applicant->division_choice2)->first()->slug;
        }

        return view('applicant.biodata', [
            'title' => $title,
            'dataMhs' => $data,
            'exists' => $isExist,
            'currentStep' => $currentStep
        ]);
    }

    public function storeBiodata(Request $request)
    {
        $request->merge(array_map('trim', $request->all()));

        $valid = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:1',
            'nrp'  => 'required|string|size:9|unique:applicants',
            'angkatan' => 'required|digits:4',
            'prodi' => 'required|string|min:1',
            'ipk' => 'required|numeric|min:0|max:4',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'line_id' => 'required|string|min:1',
            'no_hp' => ['required', 'string', 'regex:/^0[0-9]{9,13}$/'],
            'instagram' => 'required|string|min:1',
            'motivasi' => 'required|string|min:1',
            'komitmen' => 'required|string|min:1',
            'kelebihan' => 'required|string|min:1',
            'kekurangan' => 'required|string|min:1',
            'pengalaman' => 'required|string|min:1',
            'division_choice1' => 'required',
            'division_choice2' => 'required',
        ], [
            'nrp.size' => 'NRP must be exactly 9 characters',
            'no_hp.regex' => 'Whatsapp Number must start with 0 and be 10-13 digits long',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
        ]);

        if ($valid->fails()) {
            $errorString = implode('<br>', $valid->errors()->all());
            return response()->json(['success' => false, 'message' => $errorString]);
        }

        $data = $valid->validated();

        // if ($data['division_choice1'] == 'sekkonkes' || $data['division_choice2'] == 'sekkonkes') {
        //     return response()->json(['success' => false, 'message' => 'Divisi Sekkonkes sudah penuh, silahkan pilih divisi lain.']);
        // }

        // if ($data['division_choice1'] == 'transkapman' || $data['division_choice2'] == 'transkapman') {
        //     return response()->json(['success' => false, 'message' => 'Divisi Transkapman sudah penuh, silakan pilih divisi lain.']);
        // }

        if ($data['division_choice1'] === $data['division_choice2']) {
            return response()->json(['success' => false, 'message' => 'Divisi tidak boleh sama']);
        }

        $division1 = Division::where('slug', $data['division_choice1'])->first();
        $division2 = Division::where('slug', $data['division_choice2'])->first();

        try {
            Applicant::create([
                ...$data,
                'division_choice1' => $division1->id,
                'division_choice2' => $division2->id,
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil disubmit']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function berkasIndex()
    {
        $title = 'Berkas';
        $nrp = Session::get('nrp');
        $data = [];
        $isExists = Applicant::where('nrp', $nrp)->whereHas('applicantFile')->exists();
        $applicant = Applicant::where('nrp', $nrp)->first();
        if ($applicant) {
            // phase 0 -> selesai, aktif di step 2 (Berkas)
            // phase 1 -> selesai, aktif di step 3 (Jadwal)
            // phase 2 -> selesai, semua tuntas (kita sebut step 4)
            $currentStep = $applicant->phase + 2;
        }
        if($isExists){
            $applicant = Applicant::with('applicantFile')->where('nrp', $nrp)->first();
            $data['ktm'] = $applicant->applicantFile->ktm ? Storage::url($applicant->applicantFile->ktm) : null;
            $data['transkrip'] = $applicant->applicantFile->transkrip ? Storage::url($applicant->applicantFile->transkrip) : null;
            $data['bukti_kecurangan'] = $applicant->applicantFile->bukti_kecurangan ? Storage::url($applicant->applicantFile->bukti_kecurangan) : null;
            $data['skkk'] = $applicant->applicantFile->skkk ? Storage::url($applicant->applicantFile->skkk) : null;
            $data['portofolio'] = $applicant->applicantFile->portofolio ?? null;
        }

        return view('applicant.berkas', [
            'title' => $title,
            'data' => $data,
            'isExists' => $isExists,
            'currentStep' => $currentStep
        ]);
    }

    public function storeKtm(Request $request)
    {
        $rules = [
            'ktm' => 'required|mimes:pdf|max:5120',
        ];
        $messages = [
            'ktm.required' => 'KTM is required',
            'ktm.mimes' => 'KTM must be .pdf',
            'ktm.max' => 'KTM must be under 5 MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errorString = implode('<br>', $validator->errors()->all());
            return response()->json(['success' => false, 'message' => $errorString]);
        }

        $nrp = Session::get('nrp');
        $applicant = Applicant::where('nrp', $nrp)->first();

        $ktm = $request->file('ktm');
        $ktmPath = $ktm->storePubliclyAs('uploads/berkas/ktm', $nrp . '_ktm.' . $ktm->getClientOriginalExtension(), 'public');

        $applicant->applicantFile()->updateOrCreate([
            'applicant_id' => $applicant->id,
        ], [
            'ktm' => $ktmPath,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disubmit']);
    }

    public function storeTranskrip(Request $request)
    {
        $rules = [
            'transkrip' => 'required|mimes:pdf|max:5120',
        ];
        $messages = [
            'transkrip.required' => 'Transkrip is required',
            'transkrip.mimes' => 'Transkrip must be .pdf',
            'transkrip.max' => 'Transkrip must be under 5 MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errorString = implode('<br>', $validator->errors()->all());
            return response()->json(['success' => false, 'message' => $errorString]);
        }

        $nrp = Session::get('nrp');
        $applicant = Applicant::where('nrp', $nrp)->first();

        $transkrip = $request->file('transkrip');
        $transkripPath = $transkrip->storePubliclyAs('uploads/berkas/transkrip', $nrp . '_transkrip.' . $transkrip->getClientOriginalExtension(), 'public');

        $applicant->applicantFile()->updateOrCreate([
            'applicant_id' => $applicant->id,
        ], [
            'transkrip' => $transkripPath,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disubmit']);
    }

    public function storeBuktiKecurangan(Request $request)
    {
        $rules = [
            'bukti_kecurangan' => 'required|mimes:pdf|max:5120',
        ];
        $messages = [
            'bukti_kecurangan.required' => 'Bukti kecurangan is required',
            'bukti_kecurangan.mimes' => 'Bukti kecurangan must be .pdf',
            'bukti_kecurangan.max' => 'Bukti kecurangan must be under 5 MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errorString = implode('<br>', $validator->errors()->all());
            return response()->json(['success' => false, 'message' => $errorString]);
        }

        $nrp = Session::get('nrp');
        $applicant = Applicant::where('nrp', $nrp)->first();

        $buktiKecurangan = $request->file('bukti_kecurangan');
        $buktiKecuranganPath = $buktiKecurangan->storePubliclyAs('uploads/berkas/bukti_kecurangan', $nrp . '_bukti_kecurangan.' . $buktiKecurangan->getClientOriginalExtension(), 'public');

        $applicant->applicantFile()->updateOrCreate([
            'applicant_id' => $applicant->id,
        ], [
            'bukti_kecurangan' => $buktiKecuranganPath,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disubmit']);
    }

    public function storeSkkk(Request $request)
    {
        $rules = [
            'skkk' => 'required|mimes:pdf|max:5120',
        ];
        $messages = [
            'skkk.required' => 'SKKK is required',
            'skkk.mimes' => 'SKKK must be .pdf',
            'skkk.max' => 'SKKK must be under 5 MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errorString = implode('<br>', $validator->errors()->all());
            return response()->json(['success' => false, 'message' => $errorString]);
        }

        $nrp = Session::get('nrp');
        $applicant = Applicant::where('nrp', $nrp)->first();

        $skkk = $request->file('skkk');
        $skkkPath = $skkk->storePubliclyAs('uploads/berkas/skkk', $nrp . '_skkk.' . $skkk->getClientOriginalExtension(), 'public');

        $applicant->applicantFile()->updateOrCreate([
            'applicant_id' => $applicant->id,
        ], [
            'skkk' => $skkkPath,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disubmit']);
    }

    public function storePortofolio(Request $request)
    {
        $nrp = Session::get('nrp');
        $applicant = Applicant::where('nrp', $nrp)->first();

        if (!$applicant) {
            return response()->json(['success' => false, 'message' => 'Applicant not found.']);
        }

        $creativeId = Division::where('slug', 'creative')->first()->id;
        $isJoinCreative = 
            $applicant->division_choice1 == $creativeId || 
            $applicant->division_choice2 == $creativeId;

        // hanya validasi jika dia ikut creative
        if ($isJoinCreative) {
            $rules = [
                'portofolio' => 'required|url',
            ];
            $messages = [
                'portofolio.required' => 'Portofolio is required',
                'portofolio.url' => 'Portofolio field must be a valid URL',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                $errorString = implode('<br>', $validator->errors()->all());
                return response()->json(['success' => false, 'message' => $errorString]);
            }

            $applicant->applicantFile()->updateOrCreate(
                ['applicant_id' => $applicant->id],
                ['portofolio' => $request->portofolio]
            );

            return response()->json(['success' => true, 'message' => 'Portofolio berhasil disubmit']);
        }
        //Untuk bukan creative dia hrus tetap submit
        return response()->json(['success' => true, 'message' => 'Anda bukan dari divisi creative, tidak perlu submit portofolio.']);
    }

    public function checkBerkas()
    {
        $nrp = Session::get('nrp');
        $applicant = Applicant::with('applicantFile')->where('nrp', $nrp)->first();

        if (!$applicant) {
            return response()->json(['success' => false, 'message' => 'Applicant not found']);
        }

        $file = $applicant->applicantFile;
        if (!$file) {
            return response()->json(['success' => false, 'message' => 'File belum diupload']);
        }

        $creativeId = Division::where('slug', 'creative')->first()->id;
        $isCreative = $applicant->division_choice1 == $creativeId || $applicant->division_choice2 == $creativeId;

        // daftar kolom wajib
        $requiredFiles = ['ktm', 'transkrip', 'bukti_kecurangan', 'skkk'];
        if ($isCreative) $requiredFiles[] = 'portofolio';

        // cek satu-satu
        foreach ($requiredFiles as $fileField) {
            if (empty($file->$fileField)) {
                return response()->json([
                    'success' => false,
                    'message' => "Berkas {$fileField} belum diupload"
                ]);
            }
        }

        if($applicant->phase == 0) {
            $applicant->phase = 1;
            $applicant->save();

            return response()->json([
                'success' => true,
                'message' => 'Berkas sudah lengkap, silakan lanjut ke tahap berikutnya'
            ]);
        }

        // kalau semua sudah lengkap
        return response()->json([
            'success' => true,
            'message' => 'Semua berkas sudah lengkap, silakan lanjut ke tahap berikutnya'
        ]);
    }

public function jadwalIndex()
    {
        $title = 'Jadwal Interview';
        $nrp = Session::get('nrp');
        $applicant = Applicant::with(['division1', 'division2'])->where('nrp', $nrp)->first();

        if (!$applicant) {
            return redirect()->route('login')->with('error', 'Data pendaftar tidak ditemukan.');
        }
        
        $currentStep = $applicant->phase + 2;
        $isExists = AdminSchedule::where('applicant_id', $applicant->id)->exists();

        // Ambil CP Line ID dari Koordinator Divisi Choice 1
        $adminsDivisi1 = Admin::where('division_id', $applicant->division_choice1)
                               ->where('position', 'koordinator')
                               ->first();

        $contactPersonLineId = $adminsDivisi1->id_line ?? '@092sqzfy'; 
        
        $interviews = [];
        $schedules = collect();
        $divisionName = '';
        
        if ($isExists) {
            $interview = AdminSchedule::with(['admin', 'schedule'])
                ->where('applicant_id', $applicant->id)
                ->first();
                
            if ($interview) {
                $interviews['interview1'] = [
                    'division' => $applicant->division1->name . ($applicant->division2 ? ' & ' . $applicant->division2->name : ''),
                    'adminName' => $interview->admin->anonymous_name ?? 'N/A',
                    'link_gmeet' => $interview->admin->link_gmeet ?? null,
                    'location' => $interview->admin->location ?? null,
                    'mode' => $interview->isOnline,
                    'tanggal' => $interview->schedule->tanggal ?? null,
                    'jam' => $interview->schedule->jam_mulai ?? null,
                    'id_line' => $interview->admin->id_line ?? null,
                ];
            }
        } else {
            // LOGIKA FILTER JADWAL
            $allSchedules = $this->getAllAvailableSchedules();
            // dd($allSchedules);
            $divisionId1 = $applicant->division_choice1;
            $divisionId2 = $applicant->division_choice2;
            $bphId = Division::where('slug', 'bph')->value('id');

            $schedulesDiv1 = $allSchedules->where('division_id', $divisionId1);
            $schedulesDiv2 = $divisionId2 ? $allSchedules->where('division_id', $divisionId2) : collect();
            $schedulesBph = $allSchedules->where('division_id', $bphId);

            // Prioritas 1: Divisi Pilihan 1
            if ($schedulesDiv1->isNotEmpty()) {
                $schedules = $schedulesDiv1;
                $divisionName = $applicant->division1->name;
            } 
            // Prioritas 2: Divisi Pilihan 2
            else if ($schedulesDiv2->isNotEmpty()) {
                $schedules = $schedulesDiv2;
                $divisionName = $applicant->division2->name;
            } 
            // Prioritas 3: BPH (Slot Cadangan Umum)
            else if ($schedulesBph->isNotEmpty()) {
                $schedules = $schedulesBph;
                $divisionName = 'Divisi BPH (Slot Cadangan)';
            } 

            if ($schedules->isEmpty()) {
                // Email otomatis ke koordinator jika jadwal habis
                if ($adminsDivisi1) {
                    try {
                        Mail::to($adminsDivisi1->nrp . '@john.petra.ac.id')->queue(new NoScheduleAvailable($applicant));
                    } catch (\Exception $e) { Log::error($e->getMessage()); }
                }
                
                return view('applicant.jadwal', [
                    'title' => $title,
                    'schedules' => [],
                    'interviews' => [],
                    'isExists' => false,
                    'divisionName' => '',
                    'noSchedulesAvailable' => true,
                    'contactPersonLineId' => $contactPersonLineId,
                    'currentStep' => $currentStep
                ]);
            }
        }
        
        return view('applicant.jadwal', [
            'title' => $title,
            'schedules' => $schedules->values(),
            'interviews' => $interviews,
            'isExists' => $isExists,
            'divisionName' => $divisionName,
            'contactPersonLineId' => $contactPersonLineId,
            'currentStep' => $currentStep
        ]);
    }

private function getAllAvailableSchedules()
{
    // Gunakan startOfDay agar jam saat ini tidak memotong pencarian tanggal hari ini
    $today = Carbon::now('Asia/Jakarta')->startOfDay();
    
    return AdminSchedule::select(
            'admin_schedules.id as admin_schedule_id', 
            'schedules.tanggal', 
            'schedules.jam_mulai', 
            'admin_schedules.isOnline',
            'admins.id_line',
            'admins.division_id'
        )
        ->join('schedules', 'admin_schedules.schedule_id', '=', 'schedules.id')
        ->join('admins', 'admin_schedules.admin_id', '=', 'admins.id')
        ->whereNull('admin_schedules.applicant_id')
        // Pastikan format tanggal sesuai YYYY-MM-DD
        ->where('schedules.tanggal', '>=', $today->toDateString())
        ->orderBy('schedules.tanggal', 'asc')
        ->orderBy('schedules.jam_mulai', 'asc')
        ->get();
}
    public function storeJadwal(Request $request)
    {
        $val = Validator::make($request->all(), [
            'interview_mode' => 'required|in:0,1',
            'tanggal_choice' => 'required|date',
            'jam_choice' => 'required',
            'division_group' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['success' => false, 'message' => implode('<br>', $val->errors()->all())]);
        }

        $nrp = Session::get('nrp');
        $applicant = Applicant::where('nrp', $nrp)->first();
        
        if (!$applicant) return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        if (AdminSchedule::where('applicant_id', $applicant->id)->exists()) {
            return response()->json(['success' => false, 'message' => 'Anda sudah memiliki jadwal.']);
        }

        // VALIDASI H-1 JAM 21:00
        $now = Carbon::now('Asia/Jakarta');
        $chosenDate = Carbon::parse($request->tanggal_choice);
        
        // Jika memilih jadwal besok, tapi sekarang sudah lewat jam 21:00
        if ($now->hour >= 21 && $chosenDate->isTomorrow()) {
            return response()->json([
                'success' => false, 
                'message' => 'Pemesanan jadwal untuk besok ditutup setiap jam 21:00. Silakan pilih tanggal lain.'
            ]);
        }

        // Validasi tambahan: Tidak bisa pilih jadwal yang jamnya sudah lewat hari ini
        if ($chosenDate->isToday()) {
            $chosenDateTime = Carbon::parse($request->tanggal_choice . ' ' . $request->jam_choice);
            if ($now->gt($chosenDateTime->subHours(2))) {
                return response()->json(['success' => false, 'message' => 'Jadwal minimal dipilih 2 jam sebelum mulai.']);
            }
        }

        try {
            DB::beginTransaction();
            
            $schedule = Schedule::where('tanggal', $request->tanggal_choice)
                ->where('jam_mulai', $request->jam_choice)
                ->first();

            // Cari slot Admin yang tersedia di divisi yang sesuai dengan division_group
            $adminSchedule = AdminSchedule::join('admins', 'admin_schedules.admin_id', '=', 'admins.id')
                ->join('divisions', 'admins.division_id', '=', 'divisions.id')
                ->where('admin_schedules.schedule_id', $schedule->id)
                ->where('admin_schedules.isOnline', (int) $request->interview_mode)
                ->whereNull('admin_schedules.applicant_id')
                // Mencocokkan dengan nama divisi yang tampil di UI (division_group)
                ->where(function($q) use ($request) {
                    $q->where('divisions.name', $request->division_group)
                      ->orWhere(DB::raw("'Divisi BPH (Slot Cadangan)'"), $request->division_group);
                })
                ->lockForUpdate()
                ->select('admin_schedules.*', 'admins.name as admin_real_name', 'admins.nrp as admin_nrp')
                ->first();

            if (!$adminSchedule) {
                throw new \Exception('Maaf, slot ini baru saja diambil orang lain. Silakan pilih jam lain.');
            }

            $adminSchedule->applicant_id = $applicant->id;
            $adminSchedule->save();

            $applicant->phase = 2; // Naik ke tahap selesai pilih jadwal
            $applicant->save();

            DB::commit();

            // Kirim Email Notifikasi
            try {
                Mail::to($adminSchedule->admin_nrp . '@john.petra.ac.id')->queue(new ScheduleNotif([
                    'name' => $adminSchedule->admin_real_name,
                    'hari' => Carbon::parse($schedule->tanggal)->translatedFormat('l'),
                    'tanggal' => Carbon::parse($schedule->tanggal)->format('d F Y'),
                    'jam' => $schedule->jam_mulai,
                    'isOnline' => $adminSchedule->isOnline,
                ]));
            } catch (\Exception $e) { Log::error("Email Error: " . $e->getMessage()); }

            return response()->json(['success' => true, 'message' => 'Jadwal berhasil disimpan!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function login()
    {
        if (session('nrp') && session('email') && session('angkatan')) {
            return redirect()->route('applicant.homepage');
        }
        return view('applicant.login');
    }

    public function registerNow()
    {
        $nrp = session('nrp');

        if (!$nrp) {
            return redirect()->route('applicant.login');
        }

        $applicant = Applicant::where('nrp', $nrp)->first();

        if (!$applicant) {
            return redirect()->route('applicant.biodata');
        }

        switch ($applicant->phase) {
            case 0:
                return redirect()->route('applicant.berkas');
            case 1:
                return redirect()->route('applicant.jadwal');
            case 2:
                return redirect()->route('applicant.jadwal');
            default:
                return redirect()->route('applicant.homepage');
        }
    }

}
