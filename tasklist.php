<?php

	require('config.php');
	dol_include_once('/projet/class/task.class.php');
	dol_include_once('/projet/class/projet.class.php');
	dol_include_once('/user/class/usergroup.class.php');
	dol_include_once('/core/lib/date.lib.php');
	
	if($conf->asset->enabled) dol_include_once('/asset/class/ordre_fabrication_asset.class.php');
	if($conf->workstation->enabled) dol_include_once('/workstation/class/workstation.class.php');

    $conf->use_javascript_ajax = false; // 3.7 compatibility
    
    if($conf->workstation->enabled) $langs->load('workstation@workstation');
	if($conf->asset->enabled) $langs->load('asset@asset');
	
	$PDOdb = new TPDOdb;
?>
<!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> -->
<!DOCTYPE html>
<html>
	<head>
		<title>Dolibarr - <?php echo $langs->trans('Tasklist'); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="js/jquery.mobile-1.4.5.min.css" />
		<link rel="stylesheet" href="js/jquery.mobile.popup.css" />
		
		<link rel="stylesheet" href="css/style.css"/>
		
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="js/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
		
		
	</head>
	<body>		
	    
		<div id="list-task-user" data-role="page">
		    <div data-role="header">
                <h1>Tâches par utilisateur</h1>
                <div data-role="navbar">
                    <ul>
                        <li><a href="#list-task-user" id="onglet1" class="ui-btn-active"><?php echo $langs->trans('Users'); ?></a></li>
                        <?php if($conf->workstation->enabled && $user->rights->workstation->all->read){ ?><li><a  href="#list-task-workstation" id="onglet2"><?php echo $langs->trans('WorkStations'); ?></a></li><?php } ?>
                        <?php if($conf->asset->enabled && $user->rights->asset->of->lire){ ?><li><a  href="#list-task-of" id="onglet3"><?php echo $langs->trans('OFAsset'); ?></a></li><?php } ?>
                    </ul>
                </div>
            </div><!-- /header -->
			<div role="main" class="ui-content">
			    	<!-- Affichage de l'onglet "Utilisateur" --> 
						<?php require('./tpl/tasklist.onglet.utilisateurs.php'); ?>
						<div id='liste_tache_user' style="width:100%;" data-role="collapsibleset" data-theme="a" data-content-theme="a">
							
						</div>
					
					
			</div>
		</div>
		
		
        <div id="list-task-workstation" data-role="page">
            <div data-role="header">
                <h1>Tâches par poste de travail</h1>
                <div data-role="navbar">
                    <ul>
                        <li><a href="#list-task-user" id="onglet1"><?php echo $langs->trans('Users'); ?></a></li>
                        <?php if($conf->workstation->enabled && $user->rights->workstation->all->read){ ?><li><a  class="ui-btn-active"  href="#list-task-workstation" id="onglet2"><?php echo $langs->trans('WorkStations'); ?></a></li><?php } ?>
                        <?php if($conf->asset->enabled && $user->rights->asset->of->lire){ ?><li><a  href="#list-task-of" id="onglet3"><?php echo $langs->trans('OFAsset'); ?></a></li><?php } ?>
                    </ul>
                </div>

            </div><!-- /header -->
            <div class="ui-content contenu" data-role="content" role="main">
                <?php 
                    if($conf->workstation->enabled && $user->rights->workstation->all->read){
                        ?>
                            <!-- Affichage de l'onglet "Postes de travail" -->
                            <?php require('./tpl/tasklist.onglet.workstations.php'); ?>
                            
                            <div id='liste_tache_workstation' style="width:100%;" data-role="collapsibleset" data-theme="a" data-content-theme="a"></div>
                        <?php
                    }

                ?>
                
                
            </div>
        </div>
        
        <div id="list-task-of" data-role="page">
            <div data-role="header">
                <h1>Tâches par of</h1>
                <div data-role="navbar">
                    <ul>
                        <li><a href="#list-task-user" id="onglet1"><?php echo $langs->trans('Users'); ?></a></li>
                        <?php if($conf->workstation->enabled && $user->rights->workstation->all->read){ ?><li><a href="#list-task-workstation" id="onglet2"><?php echo $langs->trans('WorkStations'); ?></a></li><?php } ?>
                        <?php if($conf->asset->enabled && $user->rights->asset->of->lire){ ?><li><a  class="ui-btn-active" href="#list-task-of" id="onglet3"><?php echo $langs->trans('OFAsset'); ?></a></li><?php } ?>
                    </ul>
                </div>

            </div><!-- /header -->
            <div class="ui-content contenu" data-role="content" role="main">
                <?php 
                   if($conf->asset->enabled && $user->rights->asset->of->lire){
                        ?>
                            <!-- Affichage de l'onglet "Ordre de fabrication" -->
                            <?php require('./tpl/tasklist.onglet.of.php'); ?>
                            
                            <div id='liste_tache_of' style="width:100%;" data-role="collapsibleset" data-theme="a" data-content-theme="a"></div>
                            
                           <?php 
                    }

                ?>
            </div>
        </div>
        <?php require('./tpl/tasklist.listeTache.php'); ?>
		<?php require('./tpl/tasklist.popup.php'); ?>
		
		<script src="js/fonctions.js" type="text/javascript"></script>
	</body>
</html>