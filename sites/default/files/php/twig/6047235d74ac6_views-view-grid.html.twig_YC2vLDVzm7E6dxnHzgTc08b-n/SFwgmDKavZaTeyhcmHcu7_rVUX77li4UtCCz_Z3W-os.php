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

/* core/themes/classy/templates/views/views-view-grid.html.twig */
class __TwigTemplate_c0c114858f251134ad10e8764a746d7c783fa6dc4c5571bada8a2b9adcd599ba extends \Twig\Template
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
        // line 28
        $context["classes"] = [0 => "views-view-grid", 1 => $this->getAttribute(        // line 30
($context["options"] ?? null), "alignment", []), 2 => ("cols-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 31
($context["options"] ?? null), "columns", []))), 3 => "clearfix"];
        // line 35
        if ($this->getAttribute(($context["options"] ?? null), "row_class_default", [])) {
            // line 36
            echo "  ";
            // line 37
            $context["row_classes"] = [0 => "views-row", 1 => ((($this->getAttribute(            // line 39
($context["options"] ?? null), "alignment", []) == "horizontal")) ? ("clearfix") : (""))];
        }
        // line 43
        if ($this->getAttribute(($context["options"] ?? null), "col_class_default", [])) {
            // line 44
            echo "  ";
            // line 45
            $context["col_classes"] = [0 => "views-col", 1 => ((($this->getAttribute(            // line 47
($context["options"] ?? null), "alignment", []) == "vertical")) ? ("clearfix") : (""))];
        }
        // line 51
        if (($context["title"] ?? null)) {
            // line 52
            echo "  <h3>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            echo "</h3>
";
        }
        // line 54
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 55
        if (($this->getAttribute(($context["options"] ?? null), "alignment", []) == "horizontal")) {
            // line 56
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 57
                echo "      <div";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["row"], "attributes", []), "addClass", [0 => ($context["row_classes"] ?? null), 1 => (($this->getAttribute(($context["options"] ?? null), "row_class_default", [])) ? (("row-" . $this->sandbox->ensureToStringAllowed($this->getAttribute($context["loop"], "index", [])))) : (""))], "method")), "html", null, true);
                echo ">
        ";
                // line 58
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "content", []));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                    // line 59
                    echo "          <div";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["column"], "attributes", []), "addClass", [0 => ($context["col_classes"] ?? null), 1 => (($this->getAttribute(($context["options"] ?? null), "col_class_default", [])) ? (("col-" . $this->sandbox->ensureToStringAllowed($this->getAttribute($context["loop"], "index", [])))) : (""))], "method")), "html", null, true);
                    echo ">";
                    // line 60
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["column"], "content", [])), "html", null, true);
                    // line 61
                    echo "</div>
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                echo "      </div>
    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            echo "  ";
        } else {
            // line 66
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 67
                echo "      <div";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["column"], "attributes", []), "addClass", [0 => ($context["col_classes"] ?? null), 1 => (($this->getAttribute(($context["options"] ?? null), "col_class_default", [])) ? (("col-" . $this->sandbox->ensureToStringAllowed($this->getAttribute($context["loop"], "index", [])))) : (""))], "method")), "html", null, true);
                echo ">
        ";
                // line 68
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["column"], "content", []));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                    // line 69
                    echo "          <div";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["row"], "attributes", []), "addClass", [0 => ($context["row_classes"] ?? null), 1 => (($this->getAttribute(($context["options"] ?? null), "row_class_default", [])) ? (("row-" . $this->sandbox->ensureToStringAllowed($this->getAttribute($context["loop"], "index", [])))) : (""))], "method")), "html", null, true);
                    echo ">";
                    // line 70
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["row"], "content", [])), "html", null, true);
                    // line 71
                    echo "</div>
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 73
                echo "      </div>
    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 75
            echo "  ";
        }
        // line 76
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/views/views-view-grid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 76,  222 => 75,  207 => 73,  192 => 71,  190 => 70,  186 => 69,  169 => 68,  164 => 67,  146 => 66,  143 => 65,  128 => 63,  113 => 61,  111 => 60,  107 => 59,  90 => 58,  85 => 57,  67 => 56,  65 => 55,  60 => 54,  54 => 52,  52 => 51,  49 => 47,  48 => 45,  46 => 44,  44 => 43,  41 => 39,  40 => 37,  38 => 36,  36 => 35,  34 => 31,  33 => 30,  32 => 28,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/classy/templates/views/views-view-grid.html.twig", "/app/core/themes/classy/templates/views/views-view-grid.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 28, "if" => 35, "for" => 56];
        static $filters = ["escape" => 52];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['escape'],
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
