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

    public function get() {
        $sql = '';// SELECT
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function add($params) {
        $emall = $params->email;

        $sql = ''; // INSERT
        $query = $this->db->prepare($sql);
        $query->execute(array(':email'));
    }

    public function edit($params) {
        $id = $params->id;
        $email = $params->email;

        $sql = ''; //UPDATE
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }

    public function del($id) {
        $sql = ''; // DELETE
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }

}
