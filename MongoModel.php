<?php
class MongoModel extends MongoClient {

    protected $collection = null;

    protected $client = null;

    public function __construct($collectionName){

        //Can use your own config here or new properties for the class.
        $config = Config::getInstance();
        //$config::mongo = "mongodb://localhost:27017"
        //$config::mongodb = "db";

        $this->client = new MongoClient($config::$mongo, array("db"=>$config::$mongodb));
        $this->collection = $this->client->selectDB($config::$mongodb)->selectCollection($collectionName);

    }

    public function update($critera, $new_object, $options = array()){
        return $this->collection->update($critera,$new_object,$options);
    }

    public function insert($array,$options = array()){
        $array['local_created_at'] = new MongoDate();
        return $this->collection->insert($array,$options);
    }

    public function delete($array, $options = array()){
        return $this->collection->remove($array, $options);
    }

    public function count($array){
        return $this->collection->count($array);
    }

    public function explain($array,$options){
        return $this->explain($array,$options);
    }

    public function find($query = array(),$fields = array(), $limit = false){

        $data = $this->collection->find($query,$fields);

        if ($limit != false) {
            return $this->toArray(iterator_to_array($data->limit($limit)));
        }

        return $this->toArray(iterator_to_array($data));
    }

    private function toArray($data) {
        $array = array();
        foreach ($data as $item) {
            $array[] = $item;
        }

        return $array;
    }

    public function findAll($query = array(),$fields = array()){
        return iterator_to_array($this->collection->find($query,$fields));
    }

    public function findOne($query = array(), $fields = array()) {
        return iterator_to_array($this->collection->findOne($query,$fields));
    }
}