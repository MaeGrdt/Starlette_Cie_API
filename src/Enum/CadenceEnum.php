<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class CadenceEnum extends Enum
{
  private const SEMAINE = 'chaque semaine';
  private const PAIRE = 'semaine paire';
  private const IMPAIRE = 'semaine impaire';
}
