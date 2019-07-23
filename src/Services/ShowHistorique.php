<?php


namespace App\Services;


class ShowHistorique
{
    public function findfName($id)
    {
        return $this->repo->GetName($id);
    }
}