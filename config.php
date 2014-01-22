<?php

//Nom du site
$config["site_nom"] = "MultiLinks Decrypter";

//Description du site
$config["site_desc"] = "Intermédiaire entre les Multi-Uploaders et vous, nous vous simplifions l'accès aux liens, sans popup ni camouflés entre une multitude de bannières.";

//Description du site
$config["site_keys"] = "decrypt, decrypter, link, unprotect, online, unprotector, crypter, protector, anti, multi-uploader, multi-upload, upload, host, héberger, file, fichier, platform, platforme, check, tester, vérifier, lien, uploader";

//Mail du webmaster
$config["admin_mail"] = "lordp.webmaster@gmail.com";

//Liste des sites Multi-Links gérés. Actuellement ne sert que pour information
$config["multilinks"] = array();
$config["multilinks"][] = array('nom' => "Go4Up");
$config["multilinks"][] = array('nom' => "Mirorii");
$config["multilinks"][] = array('nom' => "MultiUpload");
$config["multilinks"][] = array('nom' => "ExoShare");
$config["multilinks"][] = array('nom' => "JHeberg");
$config["multilinks"][] = array('nom' => "MultiUp");
$config["multilinks"][] = array('nom' => "Multi-Up");
$config["multilinks"][] = array('nom' => "MirrorCreator");
$config["multilinks"][] = array('nom' => "FlashMirrors");

//Liste des sites de stockage (hosters). Sert à ne pas m'envoyer de mail si utilisé dans le décryptage.
$config["stockages"] = array();
$config["stockages"]['uptobox.com']				= "UptoBox";
$config["stockages"]['filerio.in']				= "FileRio";
$config["stockages"]['ul.to'] 					= "Uploaded";
$config["stockages"]['uploaded.to'] 			= "Uploaded";
$config["stockages"]['uploaded.net']			= "Uploaded";
$config["stockages"]['filecloud.io'] 			= "FileCloud";
$config["stockages"]['bitshare.com'] 			= "BitShare";
$config["stockages"]['uploadhero.com'] 			= "UploadHero";
$config["stockages"]['share-online.biz']		= "Share Online";
$config["stockages"]['billionuploads.com'] 		= "Billion Uploads";
$config["stockages"]['depositfiles.com'] 		= "DepositFiles";
$config["stockages"]['putlocker.com'] 			= "PutLocker";
$config["stockages"]['zippyshare.com'] 			= "ZippyShare";
$config["stockages"]['turbobit.net']			= "TurboBit";
$config["stockages"]['mediafire.com']			= "MediaFire";
$config["stockages"]['filejungle.com']			= "FileJungle";
$config["stockages"]['uploadstation.com']		= "UploadStation";
$config["stockages"]['freakshare.com']			= "FreakShare";
$config["stockages"]['rghost.net']				= "RGHost";
$config["stockages"]['free.fr']					= "Free";
$config["stockages"]['bayfiles.com']			= "BayFiles";
$config["stockages"]['rapidshare.com']			= "RapidShare";
$config["stockages"]['hipfile.com']				= "HipFile";
$config["stockages"]['1fichier.com']			= "1Fichier";
$config["stockages"]['youwatch.org']			= "YouWatch";
$config["stockages"]['hitfile.net']				= "HitFile";
$config["stockages"]['asfile.com']				= "ASFile";
$config["stockages"]['sharebeast.com']			= "ShareBeast";
$config["stockages"]['2shared.com']				= "2Shared";
$config["stockages"]['rapidgator.net']			= "RapidGator";
$config["stockages"]['hotfile.com']				= "Hotfile";
$config["stockages"]['load.to']					= "Load.To";
$config["stockages"]['sendspace.com']			= "SendSpace";
$config["stockages"]['co.nz']					= "Mega";
$config["stockages"]['queenshare.com']			= "QueenShare";

//Liste des hosters bannis
$config["bannis"] = array();
$config["bannis"][] = "tracktrk.net";
$config["bannis"][] = "mirorii.com";

?>