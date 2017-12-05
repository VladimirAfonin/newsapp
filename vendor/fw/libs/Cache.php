<?php


namespace fw\libs;


class Cache
{
    public function __construct()
    {

    }


    /**
     * get data from cache file.
     *
     * @param $key
     * @return bool|mixed
     */
    public function get($key)
    {
        $filename =  $this->getFileName($key);
        if( file_exists($filename) ) {
            $content = unserialize(file_get_contents($filename));
            if(time() <= $content['end_time']) return $content['data'];
            unlink($filename);
        }
        return NULL;
    }

    /**
     * put data to file: caching.
     *
     * @param $key
     * @param $data
     * @param int $seconds
     * @return bool
     */
    public function set($key, $data, $seconds = 3600)
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        $filename = $this->getFileName($key);
        if( file_put_contents($filename, serialize($content)) ) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * delete data from cache.
     *
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        $filename =  $this->getFileName($key);
        if( file_exists($filename) ) {
            unlink($filename);
        }
        return TRUE;
    }

    /**
     * get file name.
     *
     * @param $key
     * @return string
     */
    public function getFileName($key)
    {
        return CACHE_DIR . DIRECTORY_SEPARATOR . md5($key) . '.txt';
    }


}