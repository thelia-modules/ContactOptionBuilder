# Contact Option Builder

Add email subject, destination email and option on form contact.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is ContactOptionBuilder.
* Activate it in your thelia administration panel

## Usage



## Hook

 - Menu Hook
 - Module configuration Hook


## Loop

### Contact Option Loop

### Input arguments

|Argument           |Description                     |
|------------------ |------------------------------- |
|**id_cob**         | id contact form                |
|**user_logout**    | bool user logon / user logout  |

### Output arguments

|Variable               |Description                           |
|---------------        |------------------------------------- |
|$ID_COB                | id contact form                      |
|$SUBJECT_COB           | email subject                        |
|$COMMANDE_OPT_COB      | bool display input choice order      |
|$COMPANY_NAME_OPT_COB  | bool display input company name      |
|$MESSAGE_OPT_COB       | what you can do with this subject    |
|$EMAIL_TO_COB          | destination email                    |

### Exemple

    {loop type="contactoptionbuilder.contact.option.loop" name="contactoptionbuilder.contact.option.loop" }
    
        {$ID_COB}
        
        {$SUBJECT_COB}
        
        {if $TYPE_USER_COB == 0}
        {/if}
        
        {if $COMMANDE_OPT_COB}
        {/if}   
         
        {if $COMPANY_NAME_OPT_COB}
        {/if}       
             
        {$EMAIL_TO_COB}
        
        {$MESSAGE_OPT_COB }    
    {/loop}