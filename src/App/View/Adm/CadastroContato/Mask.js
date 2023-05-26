class Mask
{
    static phone($phone)
    {
        return $phone
            .replace(/([\D])/g, '')
            .replace(/^([\d]{2})([9]{1})?([\d]{4})?([\d]{4})?/, "($1) $2 $3-$4");
    }

    static name($name)
    {   return $name.toLowerCase()
            .replace(
                /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
                (s) => s.toUpperCase()
            );
    }
}