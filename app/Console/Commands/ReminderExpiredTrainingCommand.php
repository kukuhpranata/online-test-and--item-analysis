<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\tTrainingDtl;
use Carbon\Carbon;
use Excel;
use App\Jobs\SendMailExpiringTraining;
use Mail;

class ReminderExpiredTrainingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sertifikat_kadaluarsa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi Status Sertifikat Kadaluarsa x < 2 bulan ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now(8);
        $today = $now->toDateString();
        $next2month = Carbon::now(8)->addMonth(2);
        
        $expiring = tTrainingDtl::with('train_hdr.train_type','train_hdr.train_category',
            'train_hdr.train_competency','employee','employee.status_karyawan')
            
            ->where(function ($query) use ($now, $next2month){
                $query->whereBetween('certificate_due_date',[$now, $next2month]);
                $query->orWhere('certificate_due_date','<=', $now);
            })->orderBy('certificate_due_date')->get();


        // dd($expiring->count());

        if($expiring){
            $file_notif_kasbon = Excel::create('Data Training Kadaluarsa'.$today  , 
                    function($excel) use ($expiring){

                        $excel->setTitle('Data Training Kadaluarsa PT Industri Kereta Api(Persero)');
                        $excel->setCreator('Sistem Monitoring Kasbon');

                        /*
                             (['data'=> 'employee.NAME' ,'name' => 'employee.NAME' , 'title' => 'NAMA','orderable' => false,'searchable' => false]),
            // (['data'=> 'div_code' ,'name' => 'div_code' , 'title' => 'Kode Divisi']),
            (['data'=> 'employee.status_karyawan.DESCRIPTION' ,'name' => 'employee.status_karyawan.DESCRIPTION' , 'title' => 'Status Pegawai','orderable' => false,'searchable' => false]),
            (['data'=> 'div_description' ,'name' => 'div_description' , 'title' => 'Divisi']),
            (['data'=> 'train_hdr.title' ,'name' => 'train_hdr.title' , 'title' => 'Judul Pelatihan']),
            (['data'=> 'train_hdr.train_competency.description' ,'name' => 'train_hdr.train_competency.description' , 'title' => 'Kompetensi Pelatihan']),
            (['data'=> 'train_hdr.train_type.description' ,'name' => 'train_hdr.train_type.description' , 'title' => 'Tipe Pelatihan']),
            (['data'=> 'train_hdr.train_category.description' ,'name' => 'train_hdr.train_category.description' , 'title' => 'Kategori Pelatihan']),
            (['data'=> 'certificate_no' ,'name' => 'certificate_no' , 'title' => 'Nomor Sertifikat']),
           
                        */
                            $excel->sheet('DataTrainingKadaluarsa_'  , 
                                    function($sheet) use($expiring){
                                $row = 1;
                                $sheet->row($row,['Nama','NIP','Divisi','Judul Pelatihan', 
                                    'Kompetensi', 'Tipe Pelatihan' , 'Kategori Pelatihan' , 'Tanggal Berlaku Sertifikat',]);

                                foreach ($expiring as $exp){
                                    $sheet->row(++$row,[
                                        $exp->employee->NAME,
                                        $exp->nip,
                                        $exp->div_description,
                                        $exp->train_hdr->title, // train_hdr.title
                                        $exp->train_hdr->train_competency->description, // train_hdr.train_competency.description
                                        $exp->train_hdr->train_type->description, // train_hdr.train_type.description
                                        $exp->train_hdr->train_category->description,// train_hdr.train_category.description
                                        $exp->certificate_due_date
                                    ]);
                                }
                            });
                        

                })->store('xls',storage_path('exports/inka/'),true);
                $file_path = $file_notif_kasbon['full'];

                dispatch(new SendMailExpiringTraining($file_path,env(MAIL_TO_ADDRESS,'agri.kridanto@inka.co.id')));
                
        }
    }
}
