<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'William Harrington - Systematic Literature Review Project';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style>

        .pagination {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: white;

        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination .active {
            background-color: #4CAF50;
            color: white;
        }

    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><span>William </span>Harrington</a>
        </div>
        <div class="top-nav-links">
            <a href="/queries">Queries</a>
            <a href="/papers">Papers</a>
            <a href="/authors">Authors</a>
            <a href="/keywords">Key Words</a>
        </div>
    </nav>
    <main class="main">
        <div class="container content">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
