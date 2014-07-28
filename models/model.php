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

class Model {

    public function __construct() {

    }

    public function getUsers() {
        $sql = '';// SELECT
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addUser($params) {
        $emall = $params->email;

        $sql = ''; // INSERT
        $query = $this->db->prepare($sql);
        $query->execute(array(':email'));
    }

    public function editUser($params) {
        $id = $params->id;
        $emall = $params->email;

        $sql = ''; //UPDATE
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }

    public function delUser($id) {
        $sql = ''; // DELETE
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }

}