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

class User extends Model {

    public function __construct() {

    }

    public function getUsers() {
        $sql = "SELECT `id`, `email`, `firstname`, `lastname` FROM `user`;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addUser($params) {
        $emall = $params->email;
        $firstname = $params->firstname;
        $lastname = $params->lastname;

        $sql = "INSERT INTO `user` (`email`, `firstname`, `lastname`) VALUES (:email, :firstname, :lastname);";
        $query = $this->db->prepare($sql);
        $query->execute(array(':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname));
    }

    public function editUser($params) {
        $id = $params->id;
        $emall = $params->email;
        $firstname = $params->firstname;
        $lastname = $params->lastname;

        $sql = "UPDATE `user` SET `email` = :email, `firstname` = :firstname, `lastname` = :lastname WHERE `id` = :id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname));
    }

    public function delUser($id) {
        $sql = "DELETE FROM `user` WHERE `id` = :id LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }

}