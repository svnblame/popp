<?php

namespace POPP\Visitor;

use POPP\Visitor\ArmyVisitor;

class TextDumpArmyVisitor extends ArmyVisitor
{
    /**
     * @var string
     */
    private string $text = '';

    /**
     * @param Unit $node
     * @return void
     */
    public function visit(Unit $node): void
    {
        $txt = '';
        $pad = 4 * $node->getDepth();
        $txt .= sprintf("%{$pad}s", "");
        $txt .= get_class($node) . ": ";
        $txt .= "bombard: " . $node->bombardStrength() . PHP_EOL;
        $this->text = $txt;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}