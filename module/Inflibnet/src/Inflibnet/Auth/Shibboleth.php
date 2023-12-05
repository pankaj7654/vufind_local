<?php

namespace Inflibnet\Auth;

class Shibboleth extends \VuFind\Auth\Shibboleth
{
    /**
     * Extract attribute from request.
     *
     * @param \Laminas\Http\PhpEnvironment\Request $request   Request object
     * @param string                               $attribute Attribute name
     *
     * @return ?string attribute value
     */
    protected function getAttribute($request, $attribute): ?string
    {
        print_r("pppppppppppppppppppppppppppp");
        if ($this->useHeaders) {
            $header = $request->getHeader($attribute);
            return ($header) ? $header->getFieldValue() : null;
        } else {
            // foreach ($_SERVER as $k=>$v)
            // echo $k . "=>" . $v . "<br>";
            return $request->getServer()->get($attribute, null);
        }
    }
}

