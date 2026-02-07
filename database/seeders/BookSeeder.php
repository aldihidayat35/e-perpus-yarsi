<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\EbookRead;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Hapus semua buku lama, lalu import data baru dari CSV perpustakaan.
     */
    public function run(): void
    {
        // Hapus semua data terkait buku
        EbookRead::query()->delete();
        Loan::query()->delete();
        Ebook::query()->delete();
        Book::query()->delete();

        $physical = Category::where('slug', 'physical')->firstOrFail();
        $ebookCat = Category::where('slug', 'ebook')->firstOrFail();

        // ── BUKU FISIK ──────────────────────────────────────────────
        $physicalBooks = [
            ['code' => '6',  'title' => 'FIQIH ZAKAT', 'author' => 'SAID BIN WAHF ALQAHTANI', 'year' => 2018, 'stock' => 1],
            ['code' => '7',  'title' => 'FIQIH MUYASSAR', 'author' => 'ABDUL AZIS MABRUK AL AHMADI DKK', 'year' => 2022, 'stock' => 1],
            ['code' => '8',  'title' => 'FIQIH AKHLAK', 'author' => 'AL ADAWI MUSHTAFA', 'year' => 2005, 'stock' => 1],
            ['code' => '9',  'title' => 'FIKIH JENAZAH', 'author' => 'SYAIKH MUHAMMAD NASSARUDIN AL ALBANI', 'year' => 2025, 'stock' => 1],
            ['code' => '10', 'title' => 'FIQIH WANITA', 'author' => 'Saikh Ibrahim Muhammad al albani', 'year' => 2024, 'stock' => 1],
            ['code' => '11', 'title' => 'FIQIH SEPUTAR MASJID', 'author' => 'Syaikh Abdullah bin Shalih al Fauzan', 'year' => 2018, 'stock' => 1],
            ['code' => '12', 'title' => 'FIQIH IBADAH HARIAN', 'author' => 'Muhammad Bin Abdurrahman al Arifi', 'year' => 2015, 'stock' => 1],
            ['code' => '13', 'title' => 'FIQIH TAMQIN', 'author' => 'Yulizar D Sanrego dkk', 'year' => 2016, 'stock' => 1],
            ['code' => '14', 'title' => 'FIQIH PRIORITAS', 'author' => 'Abdus Salam Ali Al Karbuli', 'year' => 2014, 'stock' => 1],
            ['code' => '15', 'title' => 'FIQIH ISLAM', 'author' => 'Syaikh abu syuja Alhasfihani', 'year' => 2008, 'stock' => 1],
            ['code' => '16', 'title' => 'FIQIH DARURAT', 'author' => 'Muhammad abul fattah al bayayuni', 'year' => 2018, 'stock' => 1],
            ['code' => '17', 'title' => 'ROH', 'author' => 'Ibnu Qayyim Al Jauziah', 'year' => 2024, 'stock' => 1],
            ['code' => '18', 'title' => 'HALAL HARAM DALAM ISLAM', 'author' => 'Muhammad bin shalih Al Utsaimin', 'year' => 2018, 'stock' => 1],
            ['code' => '19', 'title' => 'BIOGRAFI EMPAT IMAM MAHZAB', 'author' => 'Abdul Aziz asy Sanawi', 'year' => 2024, 'stock' => 1],
            ['code' => '20', 'title' => 'BAGI WARIS NGGAK HARUS TRAGIS', 'author' => 'Muhammad Ali ash Sabuni', 'year' => 2021, 'stock' => 1],
            ['code' => '21', 'title' => 'KEMATIAN ADALAH NIKMAT', 'author' => 'M Quraish Shihab', 'year' => 2022, 'stock' => 1],
            ['code' => '22', 'title' => 'GELAS-GELAS KRISTAL', 'author' => 'Setia Budi Utomo', 'year' => 2005, 'stock' => 1],
            ['code' => '23', 'title' => '10 ORANG DI JAMIN MASUK SYURGA', 'author' => 'Labib Mz', 'year' => 2003, 'stock' => 1],
            ['code' => '24', 'title' => 'KAMUS ARAB INDONESIA', 'author' => 'Mahmud Yunus', 'year' => 2007, 'stock' => 1],
            ['code' => '25', 'title' => 'KAMUS 3 BAHASA ARAB INGGRIS INDONESIA', 'author' => 'Akhmad Khudori', 'year' => 2017, 'stock' => 1],
            ['code' => '26', 'title' => "HADIST ARBA'IN", 'author' => 'Syaich Muhammad bin Shalih Al Utsaimin', 'year' => 2023, 'stock' => 1],
            ['code' => '27', 'title' => 'SIRAH NABAWIYAH', 'author' => 'Syaikh Shafiyurrahman Almubarakfuri', 'year' => 2025, 'stock' => 1],
            ['code' => '28', 'title' => 'MENGHADAPI UJIAN DAN COBAAN HIDUP', 'author' => 'Amir Muhammad Amir Nahidh Al Hilali', 'year' => 2020, 'stock' => 1],
            ['code' => '29', 'title' => 'DAHSYATNYA SHALAT SABAR SYUKUR DAN SEDEKAH', 'author' => 'M.Suhadi LC', 'year' => 2014, 'stock' => 1],
            ['code' => '30', 'title' => 'JIHAD EKONOMI', 'author' => 'Muhammad Ali Haji Hashim', 'year' => 2005, 'stock' => 1],
            ['code' => '31', 'title' => 'TAZKIYATUN NAFS', 'author' => 'Ibnu Qayyim Al Jauziah dkk', 'year' => 2014, 'stock' => 1],
            ['code' => '32', 'title' => 'PERMATA ILMU TAUHID', 'author' => 'Syaikh Ibrahim al laqoni', 'year' => 2023, 'stock' => 1],
            ['code' => '33', 'title' => 'SECANGKIR KOPI SEBELUM AJAL MENJEMPUT', 'author' => 'Muhammad Yasir Lc', 'year' => 2025, 'stock' => 1],
            ['code' => '34', 'title' => 'DI BALIK KESULITAN ADA KEMUDAHAN', 'author' => 'Syaikh Abdul Qadir Al jilani', 'year' => 2012, 'stock' => 1],
            ['code' => '35', 'title' => 'TATA CARA SHALAT PRAKTIS', 'author' => 'Syaikh Muhammad bin Shalih al utsaimin', 'year' => 2018, 'stock' => 1],
            ['code' => '36', 'title' => 'PENGAJARAN SHALAT', 'author' => 'Al hasan', 'year' => 2007, 'stock' => 1],
            ['code' => '37', 'title' => 'WAWASAN AL-QURAN TENTANG DOA DAN ZIKIR', 'author' => 'M. Quraish Shihab', 'year' => 2018, 'stock' => 1],
            ['code' => '38', 'title' => 'AGAR DOA DI KABULKAN', 'author' => 'SAID BIN WAHF ALQAHTANI', 'year' => 2022, 'stock' => 1],
            ['code' => '39', 'title' => 'DOA DOA RASULULLAH', 'author' => 'HAMKA', 'year' => 2022, 'stock' => 1],
            ['code' => '40', 'title' => 'BUKU INDUK DOA DAN ZIKIR AMALAN PARA NABI', 'author' => 'SYAIKH ABDURRAHIM MARDHANI', 'year' => 2017, 'stock' => 1],
            ['code' => '41', 'title' => 'MUTIARA DOA PILIHAN', 'author' => 'AHMAD MAULANA', 'year' => 2013, 'stock' => 1],
            ['code' => '42', 'title' => 'THE BATLE OF RASULULLAH PERANG BADAR - KOMIK', 'author' => 'Regu Kancil Studio', 'year' => 2025, 'stock' => 1],
            ['code' => '43', 'title' => 'SERI KHULAFAUR RASYIDIN ABU BAKAR - KOMIK 1', 'author' => 'REGU KANCIL STUDIO', 'year' => 2025, 'stock' => 1],
            ['code' => '44', 'title' => 'SERI KHULAFAUR RASYIDIN UMAR BIN KHATAB - KOMIK 2', 'author' => 'REGU KANCIL STUDIO', 'year' => 2025, 'stock' => 1],
            ['code' => '45', 'title' => 'SERI KHULAFAUR RASYIDIN UTSMAN BIN AFFAN - KOMIK 3', 'author' => 'REGU KANCIL STUDIO', 'year' => 2025, 'stock' => 1],
            ['code' => '46', 'title' => 'SERI KHULAFAUR RASYIDIN ALI BIN ABI THALIB - KOMIK 4', 'author' => 'REGU KANCIL STUDIO', 'year' => 2025, 'stock' => 1],
            ['code' => '47', 'title' => 'ENSIKLOPEDIA FIQIH PRAKTIS KITAB THAHARAH DAN SHALAT JILID 1', 'author' => 'SYAIKH HUSAIN BIN AUDAH AL-AWAISYAH', 'year' => 2016, 'stock' => 1],
            ['code' => '48', 'title' => 'ENSIKLOPEDIA FIQIH PRAKTIS KITAB THAHARAH DAN SHALAT JILID 2', 'author' => 'SYAIKH HUSAIN BIN AUDAH AL-AWAISYAH', 'year' => 2016, 'stock' => 1],
            ['code' => '49', 'title' => 'ENSIKLOPEDIA FIQIH PRAKTIS KITAB THAHARAH DAN SHALAT JILID 3', 'author' => 'SYAIKH HUSAIN BIN AUDAH AL-AWAISYAH', 'year' => 2016, 'stock' => 1],
            ['code' => '50', 'title' => 'ENSIKLOPEDIA FIQIH PRAKTIS KITAB THAHARAH DAN SHALAT JILID 4', 'author' => 'SYAIKH HUSAIN BIN AUDAH AL-AWAISYAH', 'year' => 2016, 'stock' => 1],
            ['code' => '51', 'title' => 'ENSIKLOPEDIA FIQIH PRAKTIS KITAB THAHARAH DAN SHALAT JILID 5', 'author' => 'SYAIKH HUSAIN BIN AUDAH AL-AWAISYAH', 'year' => 2016, 'stock' => 1],
            ['code' => '52', 'title' => 'ENSIKLOPEDIA FIQIH PRAKTIS KITAB THAHARAH DAN SHALAT JILID 6', 'author' => 'SYAIKH HUSAIN BIN AUDAH AL-AWAISYAH', 'year' => 2016, 'stock' => 1],
        ];

        foreach ($physicalBooks as $data) {
            Book::create(array_merge($data, [
                'category_id' => $physical->id,
                'publisher'   => null,
            ]));
        }

        // ── E-BOOK ───────────────────────────────────────────────────
        $ebooks = [
            ['code' => '54', 'title' => 'The Principles of Power - Bahasa Indonesia', 'author' => 'DION YULIANTO', 'year' => 2005, 'file' => 'ebooks/HgJZFIiycRFc3Cgrvp2m5IYSd6YkKTSnWfbvOqsO.pdf'],
            ['code' => '55', 'title' => '5 PILAR KEPEMIMPINAN DI ABAD 21', 'author' => 'Dr. dr. Agustinus Johanes Djohan, MM, FIAS.', 'year' => 2010, 'file' => 'ebooks/Jj4mak69p3A3SGIDHeXWOulaj0Mm0S2WTQ49JawS.pdf'],
            ['code' => '56', 'title' => '30 HARI JAGO JUALAN', 'author' => 'Dewa Eka Prayoga', 'year' => 2014, 'file' => 'ebooks/LyubEWcUjMeUTQUMaBoSvuhFtUhNb70rL6lzabdY.pdf'],
            ['code' => '57', 'title' => 'BUMI', 'author' => 'Tere Liye', 'year' => 2014, 'file' => 'ebooks/uyjOJsZZY8XPeNwSsD9WN3Xy7R8W2qTilnnaHJad.pdf'],
            ['code' => '58', 'title' => 'THE 5 LEVELS OF LEADERSHIP', 'author' => 'JOHN C. MAXWELL', 'year' => 2012, 'file' => null],
        ];

        foreach ($ebooks as $data) {
            $book = Book::create([
                'category_id' => $ebookCat->id,
                'code'        => $data['code'],
                'title'       => $data['title'],
                'author'      => $data['author'],
                'year'        => $data['year'],
                'publisher'   => null,
                'stock'       => null,
            ]);

            if ($data['file']) {
                Ebook::create([
                    'book_id'   => $book->id,
                    'file_path' => $data['file'],
                ]);
            }
        }

        // ── PEMINJAMAN (LOANS) ───────────────────────────────────────
        $loans = [
            ['code' => '10', 'borrower' => 'MERI AFRI YANNI (SEKRETARIAT)',    'date' => '2026-01-24'],
            ['code' => '12', 'borrower' => 'VINNY ARIESTA PISHESA (SDM)',      'date' => '2026-01-26'],
            ['code' => '19', 'borrower' => 'Rezi N',                           'date' => '2026-01-30'],
            ['code' => '21', 'borrower' => 'YESSY SUSANTI (UMUM)',             'date' => '2026-01-24'],
            ['code' => '22', 'borrower' => 'PUTRI MAHARANI',                   'date' => '2026-01-24'],
            ['code' => '23', 'borrower' => 'Annisa Apriani (mhs umn)',         'date' => '2026-01-28'],
            ['code' => '28', 'borrower' => 'YENI MEIRITA (SDM DAN DIKLAT)',    'date' => '2026-01-24'],
            ['code' => '33', 'borrower' => 'DESFIYANTI',                       'date' => '2026-01-24'],
            ['code' => '42', 'borrower' => 'DESFIYENTI (INSTALASI)',           'date' => '2026-01-24'],
            ['code' => '43', 'borrower' => 'RENVIL ARMANDO',                   'date' => '2026-01-24'],
        ];

        foreach ($loans as $loanData) {
            $book = Book::where('code', $loanData['code'])->first();
            if ($book) {
                $loanDate = Carbon::parse($loanData['date']);
                Loan::create([
                    'book_id'        => $book->id,
                    'borrower_name'  => $loanData['borrower'],
                    'borrower_phone' => '-',
                    'loan_date'      => $loanDate,
                    'due_date'       => $loanDate->copy()->addDays(14),
                    'status'         => 'borrowed',
                ]);
            }
        }

        $this->command->info('Imported: ' . count($physicalBooks) . ' buku fisik, ' . count($ebooks) . ' ebook, ' . count($loans) . ' peminjaman.');
    }
}
