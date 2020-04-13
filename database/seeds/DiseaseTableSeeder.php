<?php

use Illuminate\Database\Seeder;

use App\Models\Disease;

class DiseaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disease = new Disease();
        $disease->health_institution_id = 2;
        $disease->name = 'Covid-19';
        $disease->diseaseCode = 'D84k5yDs';
        $disease->infectionQrCode = 'demo/covid_19_infection_1586416911.png';
        $disease->recoveredQrCode = 'demo/covid_19_recovered_1586416911.png';
        $disease->deadQrCode = 'demo/covid_19_dead_1586416911.png';
        $disease->selfQuarantineQrCode = 'demo/covid_19_selfquarantine_1586416911.png';
        $disease->riskLevel = 1;
        $disease->save();

        $disease = new Disease();
        $disease->health_institution_id = 2;
        $disease->name = 'Spanish Flu';
        $disease->diseaseCode = 'Dp4k5yRs';
        $disease->infectionQrCode = 'demo/spanish_flu_infection_1586416922.png';
        $disease->recoveredQrCode = 'demo/spanish_flu_recovered_1586416922.png';
        $disease->deadQrCode = 'demo/spanish_flu_dead_1586416922.png';
        $disease->selfQuarantineQrCode = 'demo/spanish_flu_selfquarantine_1586416922.png';
        $disease->riskLevel = 2;
        $disease->save();
    }
}