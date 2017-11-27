<?php
/**
 * Created by PhpStorm.
 * User: dsanj
 * Date: 11/28/2017
 * Time: 12:08 AM
 */
require_once "./modules/db.php";

$sql = "INSERT INTO tableapp.users(name, surname, patronymic, email, password, username, id_number) VALUES
('John', 'Galt', 'Hank', 'john.galt@gmail.com', 'qwe123', 'galt', '6623022213')";

$sql .= "insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Maryanna', 'Lenham', 'Sully', 'mlenham0@gnu.org', 'Hvfmxso2', 'mlenham0', 78021461082);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Alyssa', 'Goodge', 'Tamas', 'agoodge1@nbcnews.com', 'yqxtRkdQY', 'agoodge1', 91038706164);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Leilah', 'Riccardi', 'Saree', 'lriccardi2@nasa.gov', 'Lk4X1DnCeDJk', 'lriccardi2', 63841530809);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Jenda', 'Gatheridge', 'Sauveur', 'jgatheridge3@mlb.com', 'OrMMnRDc2r', 'jgatheridge3', 89069259166);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Roslyn', 'Laxston', 'Codee', 'rlaxston4@flavors.me', 'g4P8cQn86', 'rlaxston4', 86359218653);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Shel', 'Learoyde', 'Ody', 'slearoyde5@stanford.edu', 'Ka1JyxB5mgvm', 'slearoyde5', 74166942678);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Olympe', 'Elgee', 'Leonie', 'oelgee6@hao123.com', 'NMobHVkg', 'oelgee6', 84155269228);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Jacqui', 'Rutigliano', 'Krissy', 'jrutigliano7@tamu.edu', '2h0RWQ8wVH', 'jrutigliano7', 80319323659);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Fedora', 'Chominski', 'Vere', 'fchominski8@sohu.com', 'eFx3KRRbvjJ', 'fchominski8', 65013054240);
        insert into tableapp.users (name, surname, patronymic, email, password, username, id_number) values ('Consolata', 'Tonkes', 'Kayne', 'ctonkes9@liveinternet.ru', 'dkTBakTTa', 'ctonkes9', 72175056424);
        INSERT INTO tasks VALUES
(1, '2017-11-20 05:10:43', 5, 6, 'Исправить баг', 'При сохранении пользователя, страница не перезагружается');";


if($conn->multi_query($sql)){
    echo "Successfully inserted!";
} else{
    echo "Already inserted!";
}