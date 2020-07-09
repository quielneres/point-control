<?php

include 'config/Connection.php';

class PointController
{
    public function checkPoint()
    {
        $db = new Connection();
        $sql = "select *from point_register where created_at LIKE  '%" . date('Y-m-d') . "%';";
        $ret = $db->query($sql);
        $registers = $ret->fetchArray(SQLITE3_ASSOC);
        $db->close();

        if ($registers) {

            $time = $this->calcTime($registers);

            $sum_partials =  str_replace(':', '.', '08:00') - str_replace(':', '.', $time['time']);
            $left = $this->float_min($sum_partials);

            $time_control = [
                'end_day' => $time['end_day'],
                'hours_done' => $time['time'],
                'hours_left' => $left
            ];
            return json_encode(['status' => true, 'data' => $registers, 'time_control' => $time_control]);
        }
        return json_encode(['status' => false, 'message' => 'There isn\'t point register!']);
    }

    public function calcTime($registers){

        if($registers['hour_start']){

            $now = date('H:i');
            $start = $registers['hour_start'];
            $end_day = false;

            $partial = $this->calc($now, $start);

            if($registers['hour_exit_lunch']){
                $partial_exit_lunch = $this->calc($registers['hour_exit_lunch'], $registers['hour_start']);
                $partial = $partial_exit_lunch;
            }

            if($registers['hour_back_lunch']){
                $partial_back = $this->calc($now, $registers['hour_back_lunch']);
                $sum_partials =  str_replace(':', '.', $partial) + str_replace(':', '.', $partial_back);
                $partial = $this->float_min($sum_partials);
            }

            if ($registers['hour_exit']){
                $first_period = $this->calc($registers['hour_exit_lunch'], $registers['hour_start']);
                $second_period = $this->calc($registers['hour_back_lunch'], $registers['hour_exit']);
                $sum_partials =  str_replace(':', '.', $first_period) + str_replace(':', '.', $second_period);
                $partial = $this->float_min($sum_partials);
                $end_day = true;
            }
            return ['time' =>$partial, 'end_day' => $end_day];
        }
    }

    public function calc($value1, $value2)
    {
        $Start = new \DateTime($value1);
        $end = new \DateTime($value2);
        $dateDiff = $Start->diff($end);
        $result = $dateDiff->format("%H:%I");

        return $result;
    }

    public function float_min($num) {
        $num = number_format($num,2);
        $num_temp = explode('.', $num);
        $num_temp[1] = $num-(number_format($num_temp[0],2));
        $saida = number_format(((($num_temp[1]) * 60 / 100)+$num_temp[0]),2);
        $saida = strtr($saida,'.',':');
        return $saida;
        // By Alexandre Quintal - alexandrequintal@yahoo.com.br
    }
}