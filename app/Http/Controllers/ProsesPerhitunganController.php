<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\InstantPerhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProsesPerhitunganController extends Controller
{
    /**
     * return view 
     */
    public function index()
    {
        $title  = 'Form Proses Perhitungan';

        return view('pages.perhitungan.index', ['title' => $title]);
    }


    public function store($data, $divide)
    {
        $datasets = [];
        $numberget          = array_column($data, 'penjualan');

        $rand               = array_rand($numberget, 1);
        // $getarray       = $numberget[$rand];
        $resultDivide       = [];
        for ($i = 0; $i < count($numberget); $i++) {
            $resultDivide[] = $numberget[$i] / $divide;
        }

        foreach ($data as $key => $value) {
            $datasets[]            = ['total_id_transaction' => $value->bkbid, 'nama' => $value->nama];
        }
        // dd($data);

        $nameAndResult      = [];
        foreach ($data as $x => $d) {
            $nameAndResult[] = [$d->nama, $d->penjualan, $resultDivide[$x]];
        }

        // dd($nameAndResult);
        $result             = array_filter($resultDivide, fn ($mins) => $mins >= 1);

        $findMax            = max($resultDivide);
        $findMin            = min($result);

        $instanceCentroid   = $this->getAlgorithm($resultDivide, $findMax, $findMin, $datasets);
        // dd($instanceCentroid);
        $updateCentroid     = $this->updateCenteroid($resultDivide, $instanceCentroid[1], $instanceCentroid[2], $datasets, 2);

        return [$instanceCentroid, $updateCentroid, $nameAndResult];
    }
    /**
     * procces value from instant list by Excel 
     */
    public function getInstantCalculate($iteration, $divide)
    {
        $dataset            = InstantPerhitungan::all()->toArray();
        $resultDivide       = $this->getDivide($dataset, $divide);
        $FilterMin          = array_filter($resultDivide, fn ($mins) => $mins >= 1);
        $max                = max($resultDivide);
        $min                = min($FilterMin);
        $instanceCentroid   = $this->getAlgorithm($resultDivide, $max, $min, $dataset);
        $updateCentroid     = $this->updateCenteroid($resultDivide, $instanceCentroid[1], $instanceCentroid[2], $dataset, $iteration);
        return [$instanceCentroid, $updateCentroid];
    }
    /**
     * return divide value from request
     */
    public function getDivide($data, $divideValue)
    {

        $result      = [];
        for ($i = 0; $i < count($data); $i++) {
            $result[] = $data[$i]['penjualan'] / $divideValue;
        }

        return $result;
    }
    /**
     * calculate first centeroid from total transaction  / divide value
     */
    public function getAlgorithm($data, $max, $min, $datasets)
    {
        $tempMax        = [];
        $tempMin        = [];
        $iterasiAwal    = [];



        for ($j = 0; $j < count($data); $j++) {
            $centeroid_1        = sqrt(pow($data[$j] - $max, 2));
            $centeroid_2        = sqrt(pow($data[$j] - $min, 2));
            if ($centeroid_1 < $centeroid_2) {
                $iterasiAwal[]  = [[$centeroid_1, $centeroid_2, $centeroid_1, 'C1']];
                $tempMax[]      = [$centeroid_1, $datasets[$j]['nama']];
            } elseif ($centeroid_2 < $centeroid_1) {
                $iterasiAwal[]  = [[$centeroid_1, $centeroid_2, $centeroid_2, 'C2']];
                $tempMin[]      = [$centeroid_2, $datasets[$j]['nama']];
            }
        }
        // dd($iterasiAwal, $tempMax, $tempMin, $datasets);

        return [$iterasiAwal, $tempMax, $tempMin, $max, $min];
    }
    /**
     * return new centeroid with new value foreach iteration 
     */
    public function updateCenteroid($data, $findMax, $findMin, $dataset, $iterasi)
    {
        /**
         * 4 STEP for use max min for point of centeroid
         * if use max min for point of centeroid uncomment this and conditional in iteration STEP - 1
         * $max            = max($findMax);
         * $findM          = array_filter($findMin, fn ($mins) => $mins >= 1);
         * $min            = min($findM);
         */
        /**
         * --------------------------------END STEP 1----------------------------------
         */


        $newCenteroids  = [];
        $tempMax        = [];
        $tempMin        = [];
        $tempPointMax   = [];
        $tempPointMin   = [];
        $tempCetnroid_1 = [];
        $tempCetnroid_2 = [];
        $c_max          = [];
        $c_min          = [];
        /**
         * STEP 2 
         * comment some variable  below this  STEP 2
         */
        // dd($findMin);
        for ($v = 0; $v < count($findMax); $v++) {
            $c_max[] = $findMax[$v][0];
        }
        for ($y = 0; $y < count($findMin); $y++) {
            $c_min[] = $findMin[$y][0];
        }

        $countCentroid_1    = count($c_max);

        $sumCenteroid_1     = array_sum($c_max);
        $pointCenteroid_1   = $sumCenteroid_1 / $countCentroid_1;
        $countCentroid_2    = count($c_min);

        $sumCenteroid_2     = array_sum($c_min);
        $pointCenteroid_2   = $sumCenteroid_2 / $countCentroid_2;
        $max                = $pointCenteroid_1;
        $min                = $pointCenteroid_2;

        /**
         * ----------------------------END STEP 2----------------------------------
         */
        try {

            for ($i = 0; $i < $iterasi; $i++) {
                /**
                 * STEP 3
                 * Uncoment conditional if you use max min for point of centeroid  STEP - 3
                 */
                // if ($iterasi > 0 && count($tempMax) != 0) {
                //     tracking point max for new centroids
                //     $max                = max($tempMax);
                //     $mapMin             = array_filter($tempMin, fn ($mins) => $mins >= 1);
                //     $min                = min($mapMin);

                //     $tempPointMax[][$i] = $max;
                //     $tempPointMin[][$i] = $min;
                // }
                /**
                 *  ----------------------------END STEP 3----------------------------------
                 */

                /**
                 * STEP 4
                 * comment 2 vaariable below this if u use max min for point of centeroid STEP 3
                 */


                if ($iterasi > 0 && count($tempMax) != 0 && count($tempMin) != 0) {
                    $countCentroid_1    = count($tempMax);
                    $sumCenteroid_1     = array_sum($tempMax);
                    $pointCenteroid_1   = $sumCenteroid_1 / $countCentroid_1;
                    $countCentroid_2    = count($tempMin);
                    $sumCenteroid_2     = array_sum($tempMin);
                    $pointCenteroid_2   = $sumCenteroid_2 / $countCentroid_2;
                    $max                = $pointCenteroid_1;
                    $min                = $pointCenteroid_2;

                    $tempCetnroid_1[$i][] = [$sumCenteroid_1, $countCentroid_1, $max];
                    $tempCetnroid_2[$i][] = [$sumCenteroid_2, $countCentroid_2, $min];
                } else {
                    $tempCetnroid_1[$i][] = [$sumCenteroid_1, $countCentroid_1, $max];
                    $tempCetnroid_2[$i][] = [$sumCenteroid_2, $countCentroid_2, $min];
                }
                /**
                 * ----------------------------END STEP 4-------------------------------------
                 */
                for ($k = 0; $k < count($data); $k++) {

                    $centeroid_1        = sqrt(pow($data[$k] - $max, 2));
                    $centeroid_2        = sqrt(pow($data[$k] - $min, 2));
                    if ($centeroid_1 < $centeroid_2) {
                        $newCenteroids[$i][]        = [$centeroid_1, $centeroid_2, $centeroid_1, 'C1'];
                        $tempPointMax[$i][]         = [$centeroid_1, $dataset[$k]['nama']];
                        $tempMax[]                  = $centeroid_1;
                    } elseif ($centeroid_2 < $centeroid_1) {
                        $newCenteroids[$i][]        = [$centeroid_1, $centeroid_2, $centeroid_2, 'C2'];
                        $tempPointMin[$i][]         = [$centeroid_2, $dataset[$k]['nama']];
                        $tempMin[]                  = $centeroid_2;
                    }
                }
                // dd($tempMax, $tempMin);
            }
            // dd($tempMax, $tempMin);
            // dd($newCenteroids);
            //dd($newCenteroids, $tempPointMax, $tempPointMin, $tempCetnroid_1);

            //dd($countCentroid_1, $countCentroid_2, $tempCetnroid_1, $tempCetnroid_2,  $newCenteroids);
            $result = [$newCenteroids, $tempCetnroid_1, $tempCetnroid_2, $tempPointMax, $tempPointMin];
            // dd($result);
            return $result;
        } catch (\Exception $e) {
            return back()->with('failed_process', $e->getMessage());
        }
    }
}
