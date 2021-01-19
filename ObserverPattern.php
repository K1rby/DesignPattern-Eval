<?php

class Magazine
{
    private $title;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}

class Editeur implements SplSubject
{
    /**
     * @var Magazine
     */
    private $magazine;

    /**
     * SplObjectStorage pour s'assurer de l'unicité des observateurs.
     *
     * @var SplObjectStorage
     */
    protected $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    /**
     * ajoute un nouvelle abonner
     *
     * @inheritdoc
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * résiliation de l'abonnement d'un abonner
     *
     * @inheritdoc
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * @inheritdoc
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Crée un magazine chez l'editeur.
     *
     * @param Magazine $magazine
     */
    public function create(Magazine $magazine)
    {
        $this->magazine = $magazine;
        echo("l'editeur vient de publier un nouveau magazine nommé '" . $magazine->getTitle() . "'\n");
        $this->notify();
    }

    /**
     * @return Magazine
     */
    public function getMagazine()
    {
        return $this->magazine;
    }
}

class Abonne implements SplObserver
{
    /**
     * @inheritdoc
     */
    public function update(SplSubject $subject)
    {
        echo("l'abonné a recu le magazine '" . $subject->getMagazine()->getTitle() . "'\n");
    }
}

$abonne = new Abonne();
$editeur = new Editeur();



$editeur->attach($abonne);
$magazine = new Magazine();
$magazine->setTitle('le magzine n°1');
$magazine2 = new Magazine();
$magazine2->setTitle('le magazine n°2');
$magazine3 = new Magazine();
$magazine3->setTitle('le magazine n°3');

$editeur->create($magazine);
$editeur->create($magazine2);
$editeur->detach($abonne);
$editeur->create($magazine3);
