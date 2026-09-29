<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $history = <<<'TEXT'
        SMK Negeri 1 Bantul memiliki perjalanan sejarah panjang yang penuh dengan perubahan dan pembaruan, dan berkembang menjadi SMK Negeri 1 Bantul yang dikenal saat ini. Sekolah ini dibangun oleh tokoh penting dari daerah maupun pusat yang memiliki visi kuat terkait dengan pendidikan untuk mencetak bibit unggul talenta untuk SMKN Negeri VI Bantul.

        Sejak awal, SMK Negeri 1 Bantul telah hadir sebagai lembaga pendidikan yang berfokus pada pengembangan kompetensi dan keterampilan teknis yang siap menjembatani lulusannya menuju dunia kerja. Pendidikan di sini tidak hanya berfokus pada aspek teori, tetapi juga pada praktik dan budaya pendidikan.

        Pada tahun 1960-an dan pada era berikutnya, SMK Negeri 1 Bantul memperkenalkan Sistem Manajemen Mutu melalui sertifikasi ISO 9001. Sertifikat ini mendokumentasikan komitmen lembaga terhadap standar mutu dan tata kelola. Program Teaching Factory (TEFA) yang terlibat menjadikan pendidikan di sekolah ini lebih praktis, sebab pembelajarannya tidak berhenti pada konsep semata.

        Dengan pengalaman lebih dari satu dekade, SMK Negeri 1 Bantul telah berkembang dalam pembangunan fasilitas, kurikulum terdokumentasi, serta kemitraan dengan berbagai sektor industri. Pendekatan pembelajaran yang aplikatif dan adaptif terhadap kebutuhan industri telah menjadi kekuatan sekolah ini.

        Sekolah ini juga aktif dalam berbagai kompetisi tingkat sekolah, provinsi, hingga nasional. Dari LKS (Lomba Kompetensi Siswa) hingga OSN (Olimpiade Sains Nasional), semangat untuk terus memberikan kontribusi nyata dan menjadikan generasi yang telah menghasilkan berbagai prestasi global.
        TEXT;

        $mission = <<<'TEXT'
        Menyiapkan sarana prasarana dan SDM yang memenuhi SNP (Standar Nasional Pendidikan)

        Melaksanakan pembelajaran yang berbasis sains dan teknologi

        Mengimplementasikan iman, takwa dan nilai-nilai karakter bangsa dalam kehidupan sehari-hari

        Melaksanakan pembelajaran berbasis lingkungan serta mengaplikasikannya dalam kehidupan sehari-hari

        Menyiapkan tamatan yang mampu mengisi dan menciptakan lapangan kerja serta mengembangkan profesionalitas di bidang bisnis.
        TEXT;

        $settings = [
            // School
            ['group' => 'school', 'key' => 'school.name', 'value' => 'SMK Negeri 1 Bantul', 'type' => 'text'],
            ['group' => 'school', 'key' => 'school.short_name', 'value' => 'SMKN 1 Bantul', 'type' => 'text'],
            ['group' => 'school', 'key' => 'school.logo', 'value' => 'images/logo.png', 'type' => 'text'],
            ['group' => 'school', 'key' => 'school.hero_image', 'value' => 'images/outsideOfSchool.png', 'type' => 'text'],
            ['group' => 'school', 'key' => 'school.tagline', 'value' => 'Membangun wajah sekolah yang dulu kusam jadi terang dan transparan dengan teknologi dan estetika.', 'type' => 'text'],
            ['group' => 'school', 'key' => 'school.tagline_short', 'value' => 'Mencetak Generasi Unggul dan Kompeten', 'type' => 'text'],

            // Contact
            ['group' => 'contact', 'key' => 'contact.address', 'value' => 'Jl. Parangtritis No.KM.11, Dukuh, Sabdodadi, Kec. Bantul, Kab. Bantul, Daerah Istimewa Yogyakarta 55715', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact.phone', 'value' => '+62 274 367 156', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact.email', 'value' => 'info@smkn1bantul.sch.id', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact.maps_url', 'value' => 'https://maps.google.com?q=SMK+Negeri+1+Bantul', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact.map_embed_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7904.107401112937!2d110.355893!3d-7.889451!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7b00889ad8f84d%3A0x2e0009ca7815eaf0!2sSMK%20Negeri%201%20Bantul!5e0!3m2!1sen!2sus!4v1760634774433!5m2!1sen!2sus', 'type' => 'text'],

            // Social
            ['group' => 'social', 'key' => 'social.youtube', 'value' => 'https://www.youtube.com/@officialsmkn1bantul', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social.instagram', 'value' => 'https://www.instagram.com/smkn1bantul?igsh=bnV1ZG9uMWR3ZGRm', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social.telegram', 'value' => 'https://t.me/PPDBSMK1BANTUL', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social.tiktok', 'value' => 'http://tiktok.com/@skansaba.id?is_from_webapp=1&sender_device=pc', 'type' => 'text'],

            // Principal
            ['group' => 'principal', 'key' => 'principal.name', 'value' => 'Raharjo, S.IP, M.Pd', 'type' => 'text'],
            ['group' => 'principal', 'key' => 'principal.photo', 'value' => 'images/kepalaSekolah.png', 'type' => 'text'],
            ['group' => 'principal', 'key' => 'principal.message', 'value' => 'Assalamualaikum warahmatullahi wabarakatuh. Salam sejahtera bagi kita semua. Saya, Raharjo, M.Pd., Kepala SMK Negeri 1 Bantul, dengan bangga menyampaikan visi dan misi sekolah kami, yaitu mencetak lulusan yang unggul, berkompeten, dan siap bersaing di dunia global. Visi ini kami wujudkan melalui pendidikan yang berbasis pada penguatan karakter, keterampilan, dan penguasaan teknologi. Kami percaya bahwa dengan pendidikan yang berkualitas, kami dapat menyiapkan generasi yang siap menghadapi tantangan masa depan, baik di dunia kerja, wirausaha, maupun pendidikan tinggi. Di SMK Negeri 1 Bantul, kami menerapkan pembelajaran yang memanusiakan hubungan, memahami konsep, membangun keberlanjutan, memilih tantangan, dan memberdayakan konteks. Dengan pendekatan ini, kami berupaya menciptakan siswa yang tidak hanya cerdas secara akademik, tetapi juga memiliki karakter yang sesuai dengan Profil Pelajar Pancasila. Kami ingin siswa mampu berkolaborasi, berinovasi, dan berkontribusi positif dalam masyarakat. Harapan besar kami adalah lulusan SMK Negeri 1 Bantul menjadi generasi yang siap kerja di dunia industri, siap berwirausaha dengan ide-ide kreatifnya, serta siap melanjutkan pendidikan ke jenjang yang lebih tinggi. Kami percaya, dengan dukungan semua pihak, cita-cita ini dapat terwujud, dan lulusan kami akan menjadi kebanggaan bangsa. Teruslah belajar, berinovasi, dan berkontribusi untuk masa depan yang lebih baik. Wassalamualaikum warahmatullahi wabarakatuh.', 'type' => 'textarea'],

            // Home copy
            ['group' => 'home', 'key' => 'home.mission_heading', 'value' => 'Menumbuhkan Harapan, Menempa Masa Depan', 'type' => 'text'],
            ['group' => 'home', 'key' => 'home.mission_text', 'value' => 'Di sekolah ini, setiap siswa adalah harapan, setiap guru adalah cahaya, setiap jurusan adalah jalan masa depan, dan setiap ruang belajar adalah jembatan menuju dunia nyata.', 'type' => 'textarea'],
            ['group' => 'home', 'key' => 'home.history_heading', 'value' => 'Perjalanan Panjang SMK Negeri 1 Bantul dalam Membangun', 'type' => 'text'],
            ['group' => 'home', 'key' => 'home.history_excerpt', 'value' => 'SMK Negeri 1 Bantul memiliki perjalanan sejarah panjang yang penuh dengan komitmen terhadap pendidikan berkualitas. Berdiri pada tahun 1968 berdasarkan Surat Keputusan Menteri Pendidikan dan Kebudayaan Nomor 213/UKK/III/1968 tertanggal 9 Juni 1968, sekolah ini awalnya bernama SMEA Negeri VI Bantul. Seiring waktu, nama sekolah berubah menjadi SMEA Negeri 1 Bantul dan kini dikenal sebagai SMK Negeri 1 Bantul. Sejak awal, SMK Negeri 1 Bantul telah hadir sebagai lembaga pendidikan yang berfokus pada pengembangan keterampilan vokasional yang siap menghadapi tuntutan dunia kerja.', 'type' => 'textarea'],

            // History page
            ['group' => 'history', 'key' => 'history.body', 'value' => trim($history), 'type' => 'textarea'],

            // Vision & mission
            ['group' => 'vision', 'key' => 'vision.points', 'value' => 'Terwujudnya sekolah berkualitas, berkarakter dan berwawasan lingkungan', 'type' => 'text'],
            ['group' => 'mission', 'key' => 'mission.points', 'value' => trim($mission), 'type' => 'textarea'],

            // Organization
            ['group' => 'organization', 'key' => 'organization.chart_image', 'value' => 'images/strukturorganisasi.jpg', 'type' => 'text'],

            // PPDB
            ['group' => 'ppdb', 'key' => 'ppdb.spmb_url', 'value' => 'https://spmb.jogjaprov.go.id/', 'type' => 'text'],
            ['group' => 'ppdb', 'key' => 'ppdb.download_url', 'value' => 'https://drive.google.com/file/d/1GE0xfkIQZXSzfsiET4xliHjlveHxyLb4/view', 'type' => 'text'],

            // SEO
            ['group' => 'seo', 'key' => 'seo.default_description', 'value' => 'Sekolah Menengah Kejuruan Negeri 1 Bantul, Yogyakarta. Mencetak generasi unggul dan kompeten melalui pendidikan vokasional berbasis teknologi dan karakter.', 'type' => 'textarea'],
            ['group' => 'seo', 'key' => 'seo.home_description', 'value' => 'Selamat datang di website resmi SMK Negeri 1 Bantul, Yogyakarta. Informasi program keahlian, berita, prestasi, dan pendaftaran siswa baru.', 'type' => 'textarea'],
            ['group' => 'seo', 'key' => 'seo.default_title_suffix', 'value' => 'Sekolah Menengah Kejuruan Negeri 1 Bantul', 'type' => 'text'],
            ['group' => 'seo', 'key' => 'seo.keywords', 'value' => 'SMKN 1 Bantul, SMK Negeri 1 Bantul, sekolah menengah kejuruan, Bantul, Yogyakarta, pendidikan vokasional', 'type' => 'text'],
            ['group' => 'seo', 'key' => 'seo.author', 'value' => 'SMK Negeri 1 Bantul', 'type' => 'text'],
            ['group' => 'seo', 'key' => 'seo.og_image', 'value' => 'images/outsideOfSchool.png', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        SiteSetting::flushCache();
    }
}
