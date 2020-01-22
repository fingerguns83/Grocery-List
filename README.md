# Grocery-List

This is the back-end code for use with Twilio.

You'll need a Twilio account in order to interface with this endpoint via SMS (but I suppose you could modify it to work as a webapp).

Once you have a Twilio account, you'll need to configure your Twilio number to send web requests to this code on your server. There's plenty of documentation to walk you through this.

The 'shell_exec' commands in this code are written...weirdly...in order to accomodate how MacOS permissions work. It's a sloppy workaround. Probably avoidable, but I have limited knowledge and this works. You'll probably need to modify those for other systems. If you are using MacOS, make sure to edit sudoers to allow '_www' to execute the script with no password.

![Grocery-List animated gif](https://media.giphy.com/media/SVHcco4wcWYvkmPriF/giphy.gif)
