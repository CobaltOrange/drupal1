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

/* core/themes/claro/templates/filter/filter-tips.html.twig */
class __TwigTemplate_86bed3150738a5bb293aba0ce13f44de7f08b8206a302ef187c7e47c9f8d9250 extends \Twig\Template
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
        // line 20
        if (($context["multiple"] ?? null)) {
            // line 21
            echo "  <h2>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Text Formats"));
            echo "</h2>
";
        }
        // line 23
        echo "
";
        // line 24
        if (twig_length_filter($this->env, ($context["tips"] ?? null))) {
            // line 25
            echo "  ";
            if (($context["multiple"] ?? null)) {
                // line 26
                echo "    <div class=\"compose-tips\">
  ";
            }
            // line 28
            echo "
  ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tips"] ?? null));
            foreach ($context['_seq'] as $context["name"] => $context["tip"]) {
                // line 30
                echo "    ";
                if (($context["multiple"] ?? null)) {
                    // line 31
                    echo "      ";
                    // line 32
                    $context["tip_classes"] = [0 => "compose-tips__item", 1 => ("compose-tips__item--name-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(                    // line 34
$context["name"])))];
                    // line 37
                    echo "      <div";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["tip"], "attributes", []), "addClass", [0 => ($context["tip_classes"] ?? null)], "method")), "html", null, true);
                    echo ">
    ";
                }
                // line 39
                echo "    ";
                if ((($context["multiple"] ?? null) || ($context["long"] ?? null))) {
                    // line 40
                    echo "      <h3>";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["tip"], "name", [])), "html", null, true);
                    echo "</h3>
    ";
                }
                // line 42
                echo "
    ";
                // line 43
                if (twig_length_filter($this->env, $this->getAttribute($context["tip"], "list", []))) {
                    // line 44
                    echo "      <ul class=\"filter-tips ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(((($context["long"] ?? null)) ? ("filter-tips--long") : ("filter-tips--short")));
                    echo "\">
      ";
                    // line 45
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["tip"], "list", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 46
                        echo "        ";
                        // line 47
                        $context["item_classes"] = [0 => "filter-tips__item", 1 => ((                        // line 49
($context["long"] ?? null)) ? ("filter-tips__item--long") : ("filter-tips__item--short")), 2 => ((                        // line 50
($context["long"] ?? null)) ? (("filter-tips__item--id-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "id", []))))) : (""))];
                        // line 53
                        echo "        <li";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => ($context["item_classes"] ?? null)], "method")), "html", null, true);
                        echo ">";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "tip", [])), "html", null, true);
                        echo "</li>
      ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 55
                    echo "      </ul>
    ";
                }
                // line 57
                echo "
    ";
                // line 58
                if (($context["multiple"] ?? null)) {
                    // line 59
                    echo "      </div>
    ";
                }
                // line 61
                echo "  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['tip'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "
  ";
            // line 63
            if (($context["multiple"] ?? null)) {
                // line 64
                echo "    </div>
  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "core/themes/claro/templates/filter/filter-tips.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 64,  135 => 63,  132 => 62,  126 => 61,  122 => 59,  120 => 58,  117 => 57,  113 => 55,  102 => 53,  100 => 50,  99 => 49,  98 => 47,  96 => 46,  92 => 45,  87 => 44,  85 => 43,  82 => 42,  76 => 40,  73 => 39,  67 => 37,  65 => 34,  64 => 32,  62 => 31,  59 => 30,  55 => 29,  52 => 28,  48 => 26,  45 => 25,  43 => 24,  40 => 23,  34 => 21,  32 => 20,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/claro/templates/filter/filter-tips.html.twig", "/app/core/themes/claro/templates/filter/filter-tips.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 20, "for" => 29, "set" => 32];
        static $filters = ["t" => 21, "length" => 24, "clean_class" => 34, "escape" => 37];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['t', 'length', 'clean_class', 'escape'],
                []
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
