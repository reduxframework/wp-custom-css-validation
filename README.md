# wp-custom-css-validation
As per discussed here: https://make.wordpress.org/themes/2015/02/03/theme-review-chat-notes a need was found to make custom css fields safe for MySQL injection. It was mentioned that JetPack had this integration built in. This is that JetPack code isolated and in an example form for any to use.

# About Redux Framework
Redux has integrated this into their default CSS validator. You can learn how to use this validation class in Redux here: http://docs.reduxframework.com/core/the-basics/validation/

# Integration
Integration is pretty strait forward. Prior to saving your data to the DB (filter/hook), you need to pass it through the code found in `validate_css.php`. Replace `$value` with your passed value before saving.

Also a warning will be echo'd on line 44 that you can just use for your own internal messaging.

## Copyright
This code is directly from WordPress JetPack and follows their CSS sanitization standards, while at the same time taking out their LESS/SCSS pre-compilers.