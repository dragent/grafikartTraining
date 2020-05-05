<?php
class Compteur
{
    private $path;
    private $compteur;
    public function __construct(string $path)
    {
        $this->path=$path;
        if(file_exists ( $this->path))
        {
            $this->compteur=file_get_contents($this->path);
        }
        else
        {
            $this->compteur=1;
            file_put_contents($this->path,$this->compteur);
        }

    }

    public function recuperer() : int
    {
        if(!file_exists($this->path))
        {
            return 0;
        }
        return $this->compteur;
    }

    public function incrementer()
    {

        $this->compteur+=1;
        file_put_contents($this->path,$this->compteur);
    }


}