# equipmentprovider
Equipment like Result object and some object values will be yours.

# What is the main reason for this project?.
- First this project was created to represent a command pattern. This is just another layer in your software architecture. 

# How to use a command?

To create a new command its very easy to handle. Write a custom command and extend it from The AbstractCommand. This implements the CommandInterface.

For example : 
class ReadFileCollectionCommand extends AbstractCommand {
.
.
.
}

Eeach command implements the execute Command. This is realy nice. All Command injects dependencies if necessary. After that only the execute method has to executed :

For Example :
$readFileCollectionCommand = new ReadFileCollectionCommand($depencendies...);
$readFileCollectionCommand->execute($filePath, $fileName);

The execute method accept optional count of parameters. Override the execute method to limit this parameter and validate the type.

For Example:
...
public function execute(...$value)
{
    //First parameter is the given count of arguments. Second the expected count of arguments
    $this->checkNumberOfArguments(func_num_args(), 2);
    //First parameter are an array of given arguments. Second is the type to validate parameters [0] => string, [1] => string
    $this->checkParameters(func_get_args(), ['string', 'string'];
}
