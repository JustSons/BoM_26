<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Division;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optimization: Fetch all divisions once to avoid multiple DB calls in a loop.
        $divisions = Division::all()->keyBy('slug');

        $adminsData = [
            // SC
            // [
            //     'name' => 'Samuel Mario Godwin',
            //     'nrp' => 'B11230018',
            //     'division_slug' => 'sc',
            //     'position' => 'Steering Committee',
            //     'anonymous_name' => 'Rigel',
            // ],
            // BPH
            [
                'name' => 'Alexander Bryan Sunarta',
                'nrp' => 'C13240012',
                'division_slug' => 'bph',
                'position' => 'Ketua Battle Of Minds',
                'anonymous_name' => 'Newton',
                'id_line' => '040200604022006',
                'link_gmeet' => 'petra.id/Newton',
                'location' => 'Selasar P4',
            ],
            [
                'name' => 'Joseph Wolfgang Winata',
                'nrp' => 'C13240013',
                'division_slug' => 'bph',
                'position' => 'Sekretaris Battle Of Minds',
                'anonymous_name' => 'Gauss',
                'id_line' => 'jwolfgang',
                'link_gmeet' => 'petra.id/Gauss',
                'location' => 'Selasar P5',
            ],
            [
                'name' => 'Etheldreda Gwyneth Widjaja',
                'nrp' => 'B12240002',
                'division_slug' => 'bph',
                'position' => 'Bendahara Battle Of Minds',
                'anonymous_name' => 'Bohr',
                'link_gmeet' => 'petra.id/Bohr',
                'location' => 'Selasar P8',
            ],
            // Acara
            [
                'name' => 'Jessica Shine Utomo',
                'nrp' => 'C13240020',
                'division_slug' => 'acara',
                'position' => 'koordinator',
                'anonymous_name' => 'Pascal',
                'id_line' => 'jessicashine11',
                'link_gmeet' => 'petra.id/Pascal',
                'location' => 'Selasar P1',
            ],
            [
                'name' => 'Elizabeth Barbie Tantama',
                'nrp' => 'C14240104',
                'division_slug' => 'acara',
                'position' => 'sub koordinator',
                'anonymous_name' => 'Volta',
                'id_line' => 'bazbethlalala',
                'link_gmeet' => 'petra.id/Volta',
                'location' => 'Selasar P1',
            ],
            //Materi
            [
                'name' => 'Vanessa The',
                'nrp' => 'B11240046',
                'division_slug' => 'materi',
                'position' => 'koordinator',
                'anonymous_name' => 'Rosalind',
                'link_gmeet' => 'petra.id/Rosalind',
                'location' => 'Selasar P6',
            ],
            [
                'name' => 'Allesia Pruedence Handoyo',
                'nrp' => 'C13240007',
                'division_slug' => 'materi',
                'position' => 'sub koordinator',
                'anonymous_name' => 'Lovelace',
                'id_line' => 'allpruedent45',
                'link_gmeet' => 'petra.id/Lovelace',
                'location' => 'Selasar P6',
            ],
            // Creative
            [
                'name' => 'Rafferta Anthonius',
                'nrp' => 'C14240016',
                'division_slug' => 'creative',
                'position' => 'koordinator',
                'anonymous_name' => 'Alexander',
                'id_line' => 'rafferta1212',
                'link_gmeet' => 'petra.id/Alexander',
                'location' => 'P2 Lab Studio',
            ],
            [
                'name' => 'Aileen Gunawan',
                'nrp' => 'H14240066',
                'division_slug' => 'creative',
                'position' => 'sub koordinator',
                'anonymous_name' => 'Tesla',
                'location' => 'Selasar Q',
                'id_line' => 'aileen.gunawan',
            ],
            // Transkapman
            [
                'name' => 'Matthew Christian Noto',
                'nrp' => 'C13240027',
                'division_slug' => 'transkapman',
                'position' => 'koordinator',
                'anonymous_name' => 'Bell',
                'id_line' => 'morris_toosoon',
                'link_gmeet' => 'petra.id/Bell',
                'location' => 'Selasar P5',
            ],
            [
                'name' => 'Jovan Keandre Tan',
                'nrp' => 'C13240001',
                'division_slug' => 'transkapman',
                'position' => 'sub koordinator',
                'anonymous_name' => 'Darwin',
                'id_line' => 'jovankeandre',
                'link_gmeet' => 'petra.id/Darwin',
                'location' => 'Selasar P5',
            ],
            // Sekkonkes
            [
                'name' => 'Shannon Alidinata',
                'nrp' => 'B12240013',
                'division_slug' => 'sekkonkes',
                'position' => 'koordinator',
                'anonymous_name' => 'Noether',
                'id_line' => 'shannonalidinata',
                'link_gmeet' => 'petra.id/Noether',
                'location' => 'Selasar P8',
            ],
            [
                'name' => 'Shannon Rahardjo',
                'nrp' => 'B12240001',
                'division_slug' => 'sekkonkes',
                'position' => 'sub koordinator',
                'anonymous_name' => 'Leavitt',
                'id_line' => 'shannonxian',
                'link_gmeet' => 'petra.id/Leavitt',
                'location' => 'Selasar P8',
            ],
            // Public Relation
            [
                'name' => 'Andrea Anastacia',
                'nrp' => 'D11240220',
                'division_slug' => 'pr',
                'position' => 'koordinator',
                'anonymous_name' => 'Galileo',
                'id_line' => 'anastaciaandrea',
            ],
            [
                'name' => 'Jessica Edelyne Peter',
                'nrp' => 'H13240032',
                'division_slug' => 'pr',
                'position' => 'wakil koordinator',
                'anonymous_name' => 'Galilei',
                'id_line' => 'im_edelyne',
                'link_gmeet' => 'petra.id/Galilei',
                'location' => 'Light Q',
            ],
            // Sponsor
            [
                'name' => 'Tiffany Irawan',
                'nrp' => 'D12240079',
                'division_slug' => 'sponsor',
                'position' => 'koordinator',
                'anonymous_name' => 'Einstein',
                'id_line' => 'tifgs',
                'link_gmeet' => 'petra.id/Einstein',
                'location' => 'Kolam Jodoh W',
            ],
            [
                'name' => 'Clarissa Alexandra',
                'nrp' => 'D11240074',
                'division_slug' => 'sponsor',
                'position' => 'wakil koordinator',
                'anonymous_name' => 'Marie',
                'id_line' => 'clarissaalexandra_28',
                'link_gmeet' => 'petra.id/Marie',
                'location' => 'Kolam Jodoh W',
            ],
            // IT
            [
                'name' => 'Jason Maximilian Ungranesia',
                'nrp' => 'C14240008',
                'division_slug' => 'it',
                'position' => 'koordinator',
                'anonymous_name' => 'Schrodinger',
                'id_line' => 'jasonm25',
                'link_gmeet' => 'petra.id/Schrodinger',
                'location' => 'Selasar P7',
            ],
            [
                'name' => 'Bryan Raharjo Utomo',
                'nrp' => 'C14240085',
                'division_slug' => 'it',
                'position' => 'wakil koordinator',
                'anonymous_name' => 'Faraday',
                'id_line' => 'baksoman',
                'link_gmeet' => 'petra.id/Faraday',
                'location' => 'Selasar P7',
            ]
        ];

        foreach ($adminsData as $adminData) {
            // Check if the division slug exists in our fetched collection
            if (isset($divisions[$adminData['division_slug']])) {
                Admin::updateOrCreate(
                    ['nrp' => $adminData['nrp']], 
                    [
                        'name' => $adminData['name'],
                        'position' => $adminData['position'],
                        'anonymous_name' => $adminData['anonymous_name'],
                        'division_id' => $divisions[$adminData['division_slug']]->id,
                        'id_line' => $adminData['id_line'] ?? null,
                        'link_gmeet' => $adminData['link_gmeet'] ?? null,
                        'location' => $adminData['location'] ?? null,
                    ]
                );
            }
        }
    }
}
