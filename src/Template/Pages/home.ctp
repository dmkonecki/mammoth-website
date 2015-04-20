<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$siteDescription = 'Lichtarge Computational Biology Lab: Home';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $siteDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
</head>
<body class="home">
    <header>
        <div id="masthead">
            <div style="float: left">
                <a align="right" href="https://www.bcm.edu/"><img class="shim" alt="BCM - Baylor College of Medicine" src="/img/baylor_logo.png"></a>
            </div>
            <div>
                <h1 align="left">Lichtarge Computational Biology Lab</h1>
            </div>
        </div>
        <div class="">
            <a href="https://www.bcm.edu/"><?= $this->Html->image('http://www.bcm.edu/images/cms/departments/015_banner.jpg') ?></a>
        </div>
    </header>
    <div id="content">
        <?php
        if (Configure::read('debug')):
            Debugger::checkSecurityKeys();
        endif;
        ?>
        <p id="url-rewriting-warning" style="background-color:#e32; color:#fff;display:none">
            URL rewriting is not properly configured on your server.
            1) <a target="_blank" href="http://book.cakephp.org/3.0/en/installation/url-rewriting.html" style="color:#fff;">Help me configure it</a>
            2) <a target="_blank" href="http://book.cakephp.org/3.0/en/development/configuration.html#general-configuration" style="color:#fff;">I don't / can't use URL rewriting</a>
        </p>

        <div class="row">
            <div class="columns large-12  database checks">
                <?php
                    try {
                        $connection = ConnectionManager::get('default');
                        $connected = $connection->connect();
                    } catch (Exception $connectionError) {
                        $connected = false;
                        $errorMsg = $connectionError->getMessage();
                        if (method_exists($connectionError, 'getAttributes')):
                            $attributes = $connectionError->getAttributes();
                            if (isset($errorMsg['message'])):
                                $errorMsg .= '<br />' . $attributes['message'];
                            endif;
                        endif;
                    }
                ?>
                <?php if ($connected): ?>
                    <p class="success">CakePHP is able to connect to the database.</p>
                <?php else: ?>
                    <p class="problem">CakePHP is NOT able to connect to the database.<br /><br /><?= $errorMsg ?></p>
                <?php endif; ?>
            </div>
        </div>

        <hr/>
        <div class="row">
            <div class="columns large-12">
                <h3 class="">Lichtarge Computational Biology Lab </h3>
                <p>
                    Our lab in the 
                    <a href="https://www.bcm.edu/departments/molecular-and-human-genetics/">Department of Molecular and Human Genetics</a>
                    marries computation with experiments to study three areas of
                    protein structure-function: the molecular basis of protein 
                    catalysis and interaction, the design of peptides and 
                    proteins, and the annotation of protein sequence and 
                    structure. In each case, our long-term goals are to engineer
                    proteins or peptides to probe and then rationally disrupt 
                    protein pathways. 
                </p>
                <p>
                    To guide experiments, we rely on an integrated computational
                    analysis of the evolution of protein sequences, structures, 
                    and functions. This phylogenomic strategy is called the 
                    <a href="http://mammoth.bcm.tmc.edu/lab.html">Evolutionary Trace (ET)</a>
                    and, most simply, it assigns to each
                    sequence residue a relative score of “functional importance”
                    . From this we can formulate hypotheses on the molecular 
                    determinants of activity and specificity, and rationally 
                    target experiments to the most relevant sites of a protein.
                </p>
                <p>
                    Current computational projects focus on the refinement and 
                    automation of the Evolutionary Trace, on the computational 
                    annotation of function, and on data integration on a 
                    proteomic scale. Our experimental focus is on the molecular 
                    mechanisms of G protein signaling, nuclear receptors, and 
                    kinases, through collaborations, and on interactions among 
                    essential bacterial gene products, in our own wetlab. Since 
                    all these proteins are of pharmaceutical interest, we hope 
                    that computation and design can together lead to novel drug 
                    targets and, eventually, to novel approaches for the 
                    development of therapeutics.
                </p>
                <p>
                    For further information, see this detailed description of 
                    our work on computational functional site prediction. Also, 
                    we have made tools available to access our Evolutionary 
                    Trace Server: the Evolutionary Trace Viewer and the 
                    Evolutionary Trace report_maker.
                </p>
                <div align="center">
                    <h3 class="">Tools:</h3>
                    <ul>
                        <li><a href="http://mammoth.bcm.tmc.edu/uea/index.html">Evolutionary Action</a>
                        <li><a href="http://mammoth.bcm.tmc.edu/uet/index.html">Evolutionary Trace</a>
                        <li><a href="http://mammoth.bcm.tmc.edu/eta/index.html">Evolutionary Trace Annotator</a>
                        <li><a href="http://mammoth.bcm.tmc.edu/gpcr/diff_GPCRA.html">GPCR Difference ET</a>
                    </ul>
                </div>
                <h3>In The News:</h3>
                <h4>Exploring gene function and parasite-host protein interactions:</h4>
                <h4>Hypothesis Generation Based on Mining the Scientific Literature:</h4>
            </div>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
