# AfdReader - AFD and AFDT Read Class

## How to

```
 use Convenia\AfdReader\AfdReader

 $objAfdReader = new AfdReader('afdt_test.txt');
 $array = $objAfdReader->getByUser();
```

 ## Response Example

```
 [016428553393] => Array
        (
            [20052015] => Array
                (
                    [01] => Array
                        (
                            [0] => Array
                                (
                                    [sequency] => 000000002
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 09:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] =>

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array
                                (
                                    [sequency] => 000000003
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 12:04:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] =>

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

Array Keys :
PIS > DDMMYY > ORDER > [In, Out]
```
