--TEST--
Disable functions by matching the calltrace
--SKIPIF--
<?php if (!extension_loaded("snuffleupagus")) die "skip"; ?>
--INI--
sp.configuration_file={PWD}/config/config_disabled_functions_chain.ini
--FILE--
<?php 

function outer() {
    function inner() {
        echo "I'm in the inner function!\n";
    }
    echo "I'm in the outer function, before the call!\n";
    inner();
    echo "I'm in the outer function, after the call!\n";
}

echo "I'm before the call to outer\n";
outer();
echo "I'm after the call to outer\n";
?>
--EXPECTF--
I'm before the call to outer
I'm in the outer function, before the call!

Fatal error: [snuffleupagus][disabled_function] Aborted execution on call of the function 'outer>inner' in %a/disabled_functions_chain.php on line 5