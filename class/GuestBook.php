<?php


class guestBook
{

    private $path;
    public function __construct(string $file)
    {

        if(!file_exists($file))
        {
            if(!is_dir($file))
            {
                mkdir($file,0777,true);
            }
            touch($file);
        }
        $this->path=$file;
    }


    /**
     * @param Message $message
     *
     * ajoute un message au fichier format json
     *
     */
    public function addMessage(Message $message)
    {
        file_put_contents($this->path,$message->toJson()."\n",FILE_APPEND);
    }


    /**
     * @return array
     *
     * recupere toutes les lignes format json et les eclate en tableau
     * renvoi un tableau de message
     */
    public function getMessage() : array
    {
        $messageFile=file_get_contents($this->path);
        $test=explode("\n",$messageFile);
        $returnTable=[];
        array_pop($test);
        foreach ( $test as $line)
        {
            $returnTable[]=Message::fromJSON($line);
        }
        return $returnTable;
    }
}