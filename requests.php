<?php 

class RequestHelper {}

abstract class ProcessRequest
{
    abstract public function process(RequestHelper $req);
}

class MainProcess extends ProcessRequest
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": doing something useful with request " . PHP_EOL;
    }
}

abstract class DecorateProcess extends ProcessRequest
{
    protected $processRequest;

    public function __construct(ProcessRequest $pr)
    {
        $this->processRequest = $pr;
    }
}

class LogRequest extends DecorateProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": logging request " . PHP_EOL;
        $this->processRequest->process($req);
    }
}

class AuthenticateRequest extends DecorateProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": authenticating request " . PHP_EOL;
        $this->processRequest->process($req);
    }
}

class StructureRequest extends DecorateProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": structuring request data " . PHP_EOL;
        $this->processRequest->process($req);
    }
}

$process = new AuthenticateRequest(new StructureRequest(new LogRequest(new MainProcess)));
$process->process(new RequestHelper());
