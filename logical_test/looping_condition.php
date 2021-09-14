<?php 
for ($i=1; $i<=50; $i++){
    
    if($i%3==0 && $i%5==0){
        print_r("FooBar");
    } else if($i%3==0) {
        print_r("Foo");
    } else if ($i%5==0) {
        print_r("Bar");
    } else {
        print_r($i);
    }
    print_r("\n");
}
