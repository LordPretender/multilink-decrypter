MultiLink-Decrypter
=========

Voici l'un de mes derniers projets perso de site internet, l'une de mes fierté : MultiLink-Decrypter.
Il fut le premier projet utilisant un Framework PHP : CodeIgniter bien que sans BDD.

En effet, le concept est plutôt simple : les visiteurs fournissent un lien du style "Multi-Upload" et le site, via cURL, récupère le code HTML afin d'y récupérer les liens.
Ces derniers étant dans les 90% des cas codés et redirigés, le système récupère aussi le vrai lien, le lien direct et en plus, va tester la validité du lien.

Malheureusement, ce genre de site (de multi liens) modifient régulièrement leur code HTML et tentent régulièrement de se protégrer contre ce genre de manipulation.
Certains étaient même parvenu à se protéger contre l'utilisation du cURL...

Par manque de temps, j'ai décidé de fermer le site.
Un jour, je le remettrait en place, mais avec un système légèrement différent où il devrait être, théoriquement impossible aux sites de se protéger...

En attendant, vous êtes libres de vous servir du code.
Attention, il n'y a que les fichiers de mon application PHP, il faut d'abord avoir installé le framework.
Par contre, débrouillez-vous, inutile de me demander de l'aide.

Site Web, modèle MVC basique, utilisant les technologies suivantes : PHP5, HTML5 et CSS3.
Il était compatible tous navigateurs et mobiles.