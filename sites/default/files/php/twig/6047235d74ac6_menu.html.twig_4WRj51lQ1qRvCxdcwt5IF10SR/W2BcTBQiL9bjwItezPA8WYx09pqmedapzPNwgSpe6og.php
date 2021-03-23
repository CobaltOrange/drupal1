<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* core/profiles/demo_umami/themes/umami/templates/components/navigation/menu.html.twig */
class __TwigTemplate_7748cd32e77310c2592b023700d294c472fdd18ad59f0e4bef28e9ed90515ad8 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 21
        echo "
";
        // line 22
        $context["menus"] = $this;
        // line 23
        echo "
";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links(($context["items"] ?? null), ($context["attributes"] ?? null), 0, ($context["menu_name"] ?? null)));
        echo " ";
        // line 32
        echo "
";
    }

    // line 33
    public function getmenu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, $__menu_name__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "menu_name" => $__menu_name__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            echo " ";
            // line 34
            echo "  ";
            $context["menus"] = $this;
            // line 35
            echo "  ";
            // line 36
            echo "  ";
            // line 37
            $context["menu_classes"] = [0 => ("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(            // line 38
($context["menu_name"] ?? null))))];
            // line 41
            echo "  ";
            // line 42
            echo "  ";
            // line 43
            $context["submenu_classes"] = [0 => (("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(            // line 44
($context["menu_name"] ?? null)))) . "__submenu")];
            // line 47
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 48
                echo "    ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 49
                    echo "      <ul";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["menu_classes"] ?? null)], "method")), "html", null, true);
                    echo "> ";
                    // line 50
                    echo "    ";
                } else {
                    // line 51
                    echo "      <ul";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["attributes"] ?? null), "removeClass", [0 => ($context["menu_classes"] ?? null)], "method"), "addClass", [0 => ($context["submenu_classes"] ?? null)], "method")), "html", null, true);
                    echo "> ";
                    // line 52
                    echo "    ";
                }
                // line 53
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 54
                    echo "      ";
                    // line 55
                    echo "      ";
                    // line 56
                    $context["item_classes"] = [0 => (("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(                    // line 57
($context["menu_name"] ?? null)))) . "__item"), 1 => (($this->getAttribute(                    // line 58
$context["item"], "is_expanded", [])) ? ((("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["menu_name"] ?? null)))) . "__item--expanded")) : ("")), 2 => (($this->getAttribute(                    // line 59
$context["item"], "is_collapsed", [])) ? ((("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["menu_name"] ?? null)))) . "__item--collapsed")) : ("")), 3 => (($this->getAttribute(                    // line 60
$context["item"], "in_active_trail", [])) ? ((("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["menu_name"] ?? null)))) . "__item--active-trail")) : (""))];
                    // line 63
                    echo "      ";
                    // line 64
                    echo "      ";
                    // line 65
                    $context["link_classes"] = [0 => (("menu-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(                    // line 66
($context["menu_name"] ?? null)))) . "__link")];
                    // line 69
                    echo "      <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => ($context["item_classes"] ?? null)], "method")), "html", null, true);
                    echo ">";
                    // line 70
                    echo "        ";
                    // line 71
                    echo "        ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($this->sandbox->ensureToStringAllowed($this->getAttribute(                    // line 73
$context["item"], "title", [])), $this->sandbox->ensureToStringAllowed($this->getAttribute(                    // line 74
$context["item"], "url", [])), $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 75
$context["item"], "attributes", []), "removeClass", [0 => ($context["item_classes"] ?? null)], "method"), "addClass", [0 => ($context["link_classes"] ?? null)], "method"))), "html", null, true);
                    // line 77
                    echo "
        ";
                    // line 78
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 79
                        echo "          ";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links($this->getAttribute($context["item"], "below", []), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1), ($context["menu_name"] ?? null)));
                        echo " ";
                        // line 80
                        echo "        ";
                    }
                    // line 81
                    echo "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 83
                echo "    </ul>
  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "core/profiles/demo_umami/themes/umami/templates/components/navigation/menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 83,  147 => 81,  144 => 80,  140 => 79,  138 => 78,  135 => 77,  133 => 75,  132 => 74,  131 => 73,  129 => 71,  127 => 70,  123 => 69,  121 => 66,  120 => 65,  118 => 64,  116 => 63,  114 => 60,  113 => 59,  112 => 58,  111 => 57,  110 => 56,  108 => 55,  106 => 54,  101 => 53,  98 => 52,  94 => 51,  91 => 50,  87 => 49,  84 => 48,  81 => 47,  79 => 44,  78 => 43,  76 => 42,  74 => 41,  72 => 38,  71 => 37,  69 => 36,  67 => 35,  64 => 34,  48 => 33,  43 => 32,  40 => 31,  37 => 23,  35 => 22,  32 => 21,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/profiles/demo_umami/themes/umami/templates/components/navigation/menu.html.twig", "/app/core/profiles/demo_umami/themes/umami/templates/components/navigation/menu.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["import" => 22, "macro" => 33, "set" => 37, "if" => 47, "for" => 53];
        static $filters = ["clean_class" => 38, "escape" => 49];
        static $functions = ["link" => 72];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'set', 'if', 'for'],
                ['clean_class', 'escape'],
                ['link']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
