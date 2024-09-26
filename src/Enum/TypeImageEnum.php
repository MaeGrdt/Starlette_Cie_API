<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class TypeImageEnum extends Enum
{
  private const SIMPLE = 'produit_simple';
  private const VARIABLE = 'produit_variable';
  private const ENROBAGE = 'enrobage';
  private const ACTUALITE = 'actualite';
  private const UTILISATEUR = 'utilisateur';
}
