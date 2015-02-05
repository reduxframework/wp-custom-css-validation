# wp-custom-css-validation
A simple example of how to use the JetPack CSSTidy integration that will pass WordPress.org validation for custom CSS fields.

# Integration
Integration is pretty strait forward. Prior to saving your data to the DB (filter/hook), you need to pass it through the code found in `validate_css.php`. Replace `$value` with your passed value before saving.

Also a warning will be echo'd on line 44 that you can just use for your own internal messaging.

## Copyright
This code is directly from WordPress JetPack and follows their CSS standards, taking out their LESS/SCSS pre-compilers.