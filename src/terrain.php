<?php

class Sea {
    private $navigability;

    public function __construct(int $navigability = 0)
    {
        $this->navigability = $navigability;
    }
}

class EarthSea extends Sea  {}

class MarsSea extends Sea {}

class Plains {}

class EarthPlains extends Plains {}

class MarsPlains extends Plains {}

class Forest {}

class EarthForest extends Forest {}

class MarsForest extends Forest  {}

class TerrainFactory
{
    private $sea;
    private $forest;
    private $plains;

    public function __construct(Sea $sea, Plains $plains, Forest $forest)
    {
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }

    public function getSea(): Sea
    {
        return clone $this->sea;
    }

    public function getPlains(): Plains
    {
        return clone $this->plains;
    }

    public function getForest(): Forest
    {
        return clone $this->forest;
    }
}

$factory = new TerrainFactory(
    new EarthSea(-1),
    new EarthPlains(),
    new EarthForest()
);

print "Earth Terrain Only:" . PHP_EOL;
print_r($earthSea = $factory->getSea());
print_r($factory->getPlains());
print_r($factory->getForest());

print PHP_EOL;

$mixedFactory = new TerrainFactory(
    new EarthSea(-5),
    new MarsPlains(),
    new EarthForest()
);

print "Mixed Terrain:" . PHP_EOL;
print_r($mixedSea = $mixedFactory->getSea());
print_r($mixedFactory->getPlains());
print_r($mixedFactory->getForest());
