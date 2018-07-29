<?php 
    class Validation {

        public $passed = false;
        private $error = [];

        function check($nilai = []){
            foreach ($nilai as $kunci => $nilai_kunci) {
                foreach ($nilai_kunci as $aturan => $nilai_aturan) {
                   switch($aturan){
                        case 'required':
                            if(trim(Input::post($kunci)) == false && $nilai_aturan == true){
                                $this->addError($aturan.' wajib di isi');
                            }
                            break;
                        case 'min':
                            if(strlen(trim(Input::post($kunci)) < $nilai_aturan)){
                                $this->addError('field '.$aturan.' minimal harus memilii'.$nilai_aturan.' karakter');
                            }
                            break;
                        case 'max':
                            if(strlen(trim(Input::post($kunci)) > $nilai_aturan)){
                                $this->addError('field '.$aturan.' maksimal '.$nilai_aturan.' karakter');
                            }
                            break;
                    }
                }
            }

            if(empty($this->error)){
                $this->passed = true;
            }
        }

        function errors(){
            return $this->error;
        }

        function addError($nilai){
            $this->error[] = $nilai;
        }

    }
?>