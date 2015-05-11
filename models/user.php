<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Models;

use Models\Model as Model;
use Engine\Db as DB;
use Engine\Cache as Cache;

class User extends Model
{
    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->cache = new Cache(__CLASS__);
    }

    public function get()
    {
        $cache_key = 'all';
        $datas = $this->cache->get($cache_key);

        if ($datas === FALSE) {
            $sql = "SELECT `id`, `email`, `firstname`, `lastname` FROM `user`;";
            $query = $this->db->prepare($sql);
            $query->execute();
            $datas = $query->fetchAll();

            $this->cache->set($cache_key, $datas);
        }

        return $datas;
    }

    public function add($params)
    {
        $emall = $params->email;
        $firstname = $params->firstname;
        $lastname = $params->lastname;

        $sql = "INSERT INTO `user` (`email`, `firstname`, `lastname`) VALUES (:email, :firstname, :lastname);";
        $query = $this->db->prepare($sql);
        $query->execute(array(':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname));

        $this->removeCache();
    }

    public function edit($params)
    {
        $id = $params->id;
        $emall = $params->email;
        $firstname = $params->firstname;
        $lastname = $params->lastname;

        $sql = "UPDATE `user` SET `email` = :email, `firstname` = :firstname, `lastname` = :lastname WHERE `id` = :id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname));

        $this->removeCache($id);
    }

    public function del($id)
    {
        $sql = "DELETE FROM `user` WHERE `id` = :id LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        $this->removeCache($id);
    }

    private function removeCache($key = '')
    {
        $this->cache->delete('all');

        if (is_array($key)) {
            foreach ($key as $k) {
                $this->cache->delete($k);
            }
        } else {
            $this->cache->delete($key);
        }
    }
}