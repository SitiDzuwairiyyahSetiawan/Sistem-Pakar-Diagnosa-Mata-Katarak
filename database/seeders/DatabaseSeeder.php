<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;
use App\Models\Symptom;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * =========================
         * DATA PENYAKIT
         * =========================
         */
        $diseases = [
            [
                'code' => 'P1',
                'name' => 'Katarak',
                'description' => 'Katarak adalah kondisi di mana lensa mata menjadi keruh, menyebabkan penglihatan buram. Kondisi ini umumnya terjadi seiring bertambahnya usia.',
                'symptoms_description' => 'Penglihatan buram bertahap, kesulitan melihat di malam hari, silau saat melihat cahaya terang, warna tampak memudar, muncul bercak putih/kuning di mata.',
                'recommendation' => 'Segera konsultasi ke dokter mata untuk pemeriksaan lebih lanjut. Katarak dapat diatasi dengan operasi penggantian lensa.'
            ],
            [
                'code' => 'P2',
                'name' => 'Glaukoma Akut',
                'description' => 'Glaukoma akut adalah kondisi darurat di mana tekanan bola mata meningkat secara tiba-tiba.',
                'symptoms_description' => 'Melihat lingkaran pelangi di sekitar cahaya, mata terasa ditekan, sakit kepala hebat, nyeri mata mendadak, mual/muntah.',
                'recommendation' => 'INI DARURAT! Segera ke IGD rumah sakit terdekat. Glaukoma akut dapat menyebabkan kebutaan permanen dalam waktu singkat.'
            ],
            [
                'code' => 'P3',
                'name' => 'Konjungtivitis',
                'description' => 'Peradangan pada konjungtiva (selaput bening yang melapisi mata).',
                'symptoms_description' => 'Mata merah, gatal, berair terus-menerus, keluar kotoran mata, sensitif terhadap cahaya.',
                'recommendation' => 'Periksakan ke dokter mata. Hindari mengucek mata. Gunakan obat tetes mata sesuai resep dokter.'
            ],
            [
                'code' => 'P4',
                'name' => 'Ablasio Retina',
                'description' => 'Lepasnya retina dari posisi normalnya.',
                'symptoms_description' => 'Melihat bintik-bintik melayang, kilatan cahaya, garis lurus tampak bergelombang, penglihatan mendadak berkurang, bayangan gelap seperti tirai.',
                'recommendation' => 'Segera ke dokter mata spesialis retina. Ablasio retina membutuhkan penanganan segera dengan operasi.'
            ],
            [
                'code' => 'P5',
                'name' => 'Sindrom Mata Kering',
                'description' => 'Kondisi di mana mata tidak menghasilkan cukup air mata atau kualitas air mata buruk.',
                'symptoms_description' => 'Mata lelah/berat, perih seperti ada debu, berair berlebihan (reaksi iritasi), sensitif cahaya, terasa panas/terbakar.',
                'recommendation' => 'Gunakan air mata buatan (tanpa pengawet). Kurangi menatap layar terlalu lama. Periksa ke dokter jika gejala berlanjut.'
            ],
            [
                'code' => 'P6',
                'name' => 'Degenerasi Makula',
                'description' => 'Kerusakan makula (bagian tengah retina) yang menyebabkan hilangnya penglihatan sentral.',
                'symptoms_description' => 'Warna tampak kusam, penglihatan tengah buram, sulit mengenali wajah, garis tampak bengkok, titik gelap di tengah pandangan.',
                'recommendation' => 'Konsultasi ke dokter mata spesialis retina. Lakukan pemeriksaan rutin jika berusia di atas 50 tahun.'
            ]
        ];

        foreach ($diseases as $disease) {
            Disease::firstOrCreate(
                ['code' => $disease['code']],
                $disease
            );
        }

        /**
         * =========================
         * DATA GEJALA
         * =========================
         */
        $symptomsData = [
            ['G1','Warna benda terlihat makin pudar atau kekuningan yang muncul secara perlahan-lahan seiring lensa mata mulai menjadi keruh.','P1',1],
            ['G2','Kesulitan melihat ketika berada di ruangan gelap atau malam hari karena mata tidak bisa menangkap cahaya dengan baik seiring waktu.','P1',2],
            ['G3','Cahaya terasa sangat menyilaukan dan tampak menyebar ketika melihat lampu atau sinar matahari yang membuat pandangan terasa tidak nyaman.','P1',3],
            ['G4','Pandangan menjadi semakin kabur sedikit demi sedikit, dan semakin mengganggu aktivitas sehari-hari bila dibiarkan dalam waktu lama.','P1',4],
            ['G5','Muncul bercak putih atau kekuningan di tengah mata yang tampak semakin jelas ketika kondisi katarak sudah semakin parah.','P1',5],

            ['G6','Cahaya tampak dikelilingi lingkaran berwarna pelangi yang muncul tiba-tiba ketika tekanan di dalam mata mulai meningkat.','P2',1],
            ['G7','Mata terasa seperti ditekan dari dalam sehingga memunculkan rasa tidak nyaman yang semakin berat dari waktu ke waktu.','P2',2],
            ['G8','Muncul sakit kepala yang kuat dan terasa menjalar sampai ke bagian belakang mata sehingga membuat penderita sulit berkonsentrasi.','P2',3],
            ['G9','Rasa sakit pada bola mata muncul tiba-tiba dan menjadi semakin parah sampai mengganggu aktivitas sehari-hari.','P2',4],
            ['G10','Rasa mual bahkan muntah sering muncul bersamaan dengan pandangan yang makin kabur ketika tekanan mata meningkat tajam.','P2',5],

            ['G11','Air mata keluar lebih banyak dari biasanya tanpa alasan yang jelas karena mata mengalami iritasi.','P3',1],
            ['G12','Mata terasa mengganjal dan tidak nyaman seperti ada pasir halus yang menggosok permukaan mata.','P3',2],
            ['G13','Bagian putih mata tampak memerah karena pembuluh darah melebar akibat infeksi atau alergi.','P3',3],
            ['G14','Mata mengeluarkan belek atau cairan lengket yang jumlahnya lebih banyak dari biasanya dan sering muncul kembali setelah dibersihkan.','P3',4],
            ['G15','Mata terasa cepat silau dan tidak nyaman ketika terkena cahaya terang walaupun cahayanya tidak terlalu kuat.','P3',5],

            ['G16','Tampak bintik-bintik kecil atau bayangan melayang yang muncul tiba-tiba dan bergerak mengikuti arah pandangan.','P4',1],
            ['G17','Muncul kilatan cahaya singkat seperti cahaya kamera meskipun tidak ada sumber cahaya di sekitar.','P4',2],
            ['G18','Garis yang seharusnya lurus tampak berbelok-belok atau bergelombang sehingga membuat objek terlihat tidak normal.','P4',3],
            ['G19','Pandangan terasa kabur secara mendadak tanpa sebab jelas yang membuat sulit melihat objek dengan jelas.','P4',4],
            ['G20','Muncul bayangan gelap seperti tirai yang perlahan menutupi sebagian bidang pandang dan semakin luas seiring waktu.','P4',5],

            ['G21','Mata terasa berat dan mudah lelah terutama saat membaca, melihat layar, atau melakukan aktivitas visual terlalu lama.','P5',1],
            ['G22','Permukaan mata terasa perih dan mengganjal seperti ada debu kecil yang membuat mata sulit merasa nyaman.','P5',2],
            ['G23','Air mata keluar terlalu banyak sebagai reaksi tubuh ketika mata sebenarnya sedang sangat kering.','P5',3],
            ['G24','Cahaya terasa menyilaukan meskipun tidak terlalu terang karena permukaan mata sedang iritasi.','P5',4],
            ['G25','Mata terasa panas, perih, atau seperti terbakar terutama setelah lama tidak berkedip.','P5',5],

            ['G26','Warna objek terlihat tidak cerah dan tampak lebih kusam karena bagian mata yang menangkap detail mulai menurun fungsinya.','P6',1],
            ['G27','Pusat penglihatan perlahan menjadi semakin buram, dan semakin mengganggu untuk membaca atau melihat objek dekat.','P6',2],
            ['G28','Detail wajah orang terlihat kabur sehingga sulit mengenali orang meskipun jaraknya tidak jauh.','P6',3],
            ['G29','Garis pada buku atau benda terlihat bengkok atau tidak rata karena kerusakan pada bagian penglihatan tengah.','P6',4],
            ['G30','Bagian tengah pandangan tampak gelap, hilang, atau tertutup kabut sehingga menyulitkan aktivitas yang butuh penglihatan detail.','P6',5],
        ];

        foreach ($symptomsData as $symptom) {
            $disease = Disease::where('code', $symptom[2])->first();

            if ($disease) {
                Symptom::firstOrCreate(
                    ['code' => $symptom[0]],
                    [
                        'description' => $symptom[1],
                        'disease_id' => $disease->id,
                        'order' => $symptom[3],
                    ]
                );
            }
        }
    }
}
