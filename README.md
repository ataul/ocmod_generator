# Opencart modification xml file generator
It automatically generates install.xml file from storage/modification folder.
You need to add comment for effective file generation.
Details can be found at:

1. In php file there must be a comment Like:

//ocmod [extension_name] replace

//ocmod [extension_name] before

//ocmod [extension_name] after

2. In twig file comment can be
&gt;!-- ocmod [extension_name] replace

