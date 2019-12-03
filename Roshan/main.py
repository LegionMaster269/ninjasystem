from kivy.app import App
from kivy.clock import Clock
from kivy.core.text import LabelBase
from kivy.core.window import Window
from kivy.utils import get_color_from_hex
from kivy.lang import Builder
from time import strftime
__version__ = "1.0.3"
kvfile = Builder.load_string("""
  
<Label>:
    font_name: 'Roboto'
    font_size: 60
    markup: True

<RobotoButton@Button>:
    font_name: 'Roboto'
    font_size: 25
    bold: True
    border: (2, 2, 2, 2)

BoxLayout:
    orientation: 'vertical'

    Label:
        id: time
        text: '[b]00[/b]:00:00'

    BoxLayout:
        height: 90
        orientation: 'horizontal'
        padding: 20
        spacing: 20
        size_hint: (1, None)

        RobotoButton:
            id: start_stop
            text: 'Start'
            

        RobotoButton:
            id: reset
            text: 'Reset'
            
            

    Label:
        id: stopwatch
        text: '00:00.[size=40]00[/size]'

        
    """)


class AIApp(App):

    def build(self):
        return kvfile
        pass

    def update_time(self, nap):
        self.root.ids.time.text = strftime('%H:%M:%S')

    def on_start(self):
        Clock.schedule_interval(self.update_time, 1)

    LabelBase.register(name="Roboto", fn_regular="avengers.ttf")


if __name__ == '__main__':
    Window.clearcolor = get_color_from_hex('#101216')

    AIApp().run()
