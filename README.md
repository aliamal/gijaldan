Gijaldan
PHP Batch Obfuscation Tool (Gijaldan)

The most powerful PHP Encryption and Obfuscation tool

This solution has a "key_file.txt" file that contains the secret key! you should fill it with some random characters, so your encryption elevates in hardness;

This project uses three main PHP specifications to obfuscate php files in batch mode:

1-Ability of symmetric encryption with a secret key in PHP (you can change it to a assymetric key for licencing targets)
2-Abiltiy of decryption of encrypted files
3-Ability of self executing of php with EVAL function

**Encryption of Files:

The encryption of the project uses a AES-128-GCM mode, for the simplicity of the work we send the IV and Tag beside the encrypted files;
a function named encryptor gets the $key and $plaintext and encryptes the file

In encryption phase, we put all the files that needs to be encrypted in the "files" folder and then we run the file: "batch_enc.php"; this file uses the "key_file.txt" file as the secret key!

**Important:
Before encryption it is important the clear the php tags : "<?php" and "?>" from the files! if several php tags are included in the php file, you need to make several seperate files for each such file and put each php block seperately in different files! then copy new files to the "files" folder and run "batch_enc.php" again; after executing this file, the result is shown in "enc_files" folder and the files are numbered from "1.php" to "n.php" where 'n' is the quantity of the files;




Handler files are located instead of main files:
after encryption, some handler files are created with the same name as the main files and you should place them at the main files place; All these handler files are as same formats: "exampleFile.php" and instead of FFFFFF.php in the context of this file the corresponding file number is written in it (the file that the handler is going to decrypt it); there is a file name "batch_wipe.php" that does this work automatically (replacing FFFFFF.php with #.php) and puts the result in the "changed_files" directory;
you should replace this directory files with the main plain files! and then you should make a directory near new files "methods" and put 1.php to n.php in it! and one version of "decryptor.php", "encryptor.php" should be copied there, ofcourse with different name e.g. decryptor1.php,encryptor1.php, decryptor2.php,encryptor2.php, so on; (this file should be imported in the handler files) and the methods inside them should be changed too! (decryptor-> decryptor1,...) and then be copied to "methods" folder!

you should place the key file in the methods folder, addressing it to the decryptor method;

see the example files for more information.















