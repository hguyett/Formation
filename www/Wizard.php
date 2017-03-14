<?php
/**
 *
 */
class Wizard extends Character
{
const HIT_DAMAGES = 8;
/**
 * Amount of Health points. When $damage reach it, the character is dead.
 * @var integer
 */
const HEALTH_POINTS = 80;
/**
 * Amount of damage required for a character to die.
 * @var integer
 */
const DEAD = self::HEALTH_POINTS;
const SKILLS_LIST = array('fireball');
const FIREBALL_DAMAGES = 20;

    function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function fireball(Character $target)
    {
        $target->setDamages($target->damages() + static::FIREBALL_DAMAGES);
    }

    public function getSkillsList(): array
    {
        return static::SKILLS_LIST;
    }
}
