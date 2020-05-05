<?php
class Creneau{
    public $debut;
    public $fin;

    public function  __construct(int $debut, int $fin)
    {
        $this->debut=$debut;
        $this->fin=$fin;
    }

    public function inclusHeure(int $heure):bool
    {
        return ($heure > $this->debut) && ($heure < $this->fin);
    }

    public function intersect(Creneau $creneau):bool
    {
        if(($this->inclusHeure($creneau->debut))||($this->inclusHeure($creneau->fin)))
        {
            return true;
        }
        else if(($creneau->inclusHeure($this->debut))||($creneau->inclusHeure($this->fin)))
        {
            return true;
        }
        return false;
    }

    public function toHMTL():string
    {
        return "<strong>".$this->debut."h</strong> à <strong>".$this->fin()."h</strong>.";
    }
}
