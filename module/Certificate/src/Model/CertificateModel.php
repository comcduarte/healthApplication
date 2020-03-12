<?php 
namespace Certificate\Model;

use Midnet\Model\DatabaseObject;

class CertificateModel extends DatabaseObject
{
    public $NAME;
    public $BIRTHPLACE;
    public $SEX;
    public $DOB;
    public $DOI;
    public $DOR;
    public $SFN;
    
    public function __construct($adapter = NULL)
    {
        parent::__construct($adapter);
        $this->setTableName('certificates');
    }
}