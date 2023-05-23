<?php

abstract class ApptEncoder
{
    abstract public function encode(): string;
}

abstract class CommsManager
{
    abstract public function getApptEncoder(): ApptEncoder;
    abstract public function getHeaderText(): string;
    abstract public function getFooterText(): string;
}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode(): string 
    {
        return 'Appointment data encoded in BloggsCal format' . PHP_EOL;
    }
}

class MegaApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return 'Appointment data encoded in MegaCal format' . PHP_EOL;
    }
}

class BloggsCommsManager extends CommsManager {
    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    }

    public function getHeaderText(): string 
    {
        return 'BloggsCal header' . PHP_EOL;
    }

    public function getFooterText(): string 
    {
        return 'BloggsCal footer' . PHP_EOL;
    }
}

class MegaCommsManager extends CommsManager
{
    public function getApptEncoder(): ApptEncoder
    {
        return new MegaApptEncoder();
    }

    public function getHeaderText(): string 
    {
        return 'MegaCal header' . PHP_EOL;
    }

    public function getFooterText(): string 
    {
        return 'MegaCal footer' . PHP_EOL;
    }
}

$bloggsMgr = new BloggsCommsManager();
print $bloggsMgr->getHeaderText();
print $bloggsMgr->getApptEncoder()->encode();
print $bloggsMgr->getFooterText();

$megaMgr = new MegaCommsManager();
print $megaMgr->getHeaderText();
print $megaMgr->getApptEncoder()->encode();
print $megaMgr->getFooterText();
