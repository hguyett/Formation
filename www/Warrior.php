<?php
/**
 *
 */
class Warrior extends Character
{

    const HIT_DAMAGES = 5;
    /**
     * Amount of Health points. When $damage reach it, the character is dead.
     * @var integer
     */
    const HEALTH_POINTS = 150;
    /**
     * Amount of damage required for a character to die.
     * @var integer
     */
    const DEAD = self::HEALTH_POINTS;
    const SKILLS_LIST = array('berzerk');
    const BERZERK_DAMAGES = 12;
    const BERZERK_DAMAGES_SELF = 2;

    function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function berzerk(Character $target)
    {
        $target->setDamages($target->damages() + static::BERZERK_DAMAGES);
        $this->receiveDamages(static::BERZERK_DAMAGES_SELF);
    }

    public function getSkillsList(): array
    {
        return static::SKILLS_LIST;
    }
}
