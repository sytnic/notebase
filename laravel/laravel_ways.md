## Способы вывода вью из контроллера

### Вью с with

```
public function table()
{
    // DB::table('products')->get()->dd();
    // $bookings = Product::all()->dd();

    // Все
    // $products = Product::all();

    // С пагинацией
    $products = Product::paginate(20);

    // вью с with
    return view('manage.products_table') 
        ->with('products', $products)
        // ->with('another', $another)
        ;
    
    
}
```

### Вью с массивом
```
public function index() {
            
        $context = ['bbs' => Bb::latest()->get()];
        
        // вью с массивом
        return view('index', $context);

    /* // вью с массивом
        return view('manage.products_table', 
          [            
            'products' => $products,
            // 'another' => $another,
          ]
        );
    */
        
    }
```

### Вывод на экран данных без представления через response
```
public function index() {

    $s = 'Здесь будет перечень объявлений.';

    return response($s)->header('Content-Type', 'text/plain');
            
}
```

## Способы получения данных из таблицы БД

### Получение через фасад и DB

```
use Illuminate\Support\Facades\DB;

public function table()
    {
       DB::table('products')->get()->dd();
    }
```

### Получение через модель

```
use App\Models\Product;

public function table()
    {
        // $bookings = Product::all()->dd();

        // Все
        $products = Product::all();
    }

```

### Получение через модель с пагинацией
```
use App\Models\Product;

public function table()
    {
        // С пагинацией
        $products = Product::paginate(20);
    }

```