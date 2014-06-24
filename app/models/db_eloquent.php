<?php
namespace DspaceNAZHTW;
use Eloquent;

class Authority extends Eloquent{
	protected $table = 'authority';
}

class Utf8Pinyin extends Eloquent{
	protected $table = 'utf8pinyin';
}

class Metaphone extends Eloquent{
	protected $table = 'metaphone';
}

