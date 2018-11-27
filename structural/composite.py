"""
Composite pattern example.
source: https://en.wikipedia.org/wiki/Composite_pattern#Python
"""
from abc import ABC, abstractmethod

NOT_IMPLEMENTED = "You should implement this."


# Component
class Graphic(ABC):
    @abstractmethod
    def print(self):
        raise NotImplementedError(NOT_IMPLEMENTED)

# "Composite" 
class CompositeGraphic(Graphic):
    def __init__(self):
        self.graphics = []

    def print(self):
        for graphic in self.graphics:
            graphic.print()

    def add(self, graphic):
        self.graphics.append(graphic)

    def remove(self, graphic):
        self.graphics.remove(graphic)

# "Leaf" 
class Ellipse(Graphic):
    def __init__(self, name):
        self.name = name

    def print(self):
        print("Ellipse:", self.name)


# "Client"
ellipse1 = Ellipse("1")
ellipse2 = Ellipse("2")
ellipse3 = Ellipse("3")
ellipse4 = Ellipse("4")

graphic = CompositeGraphic()
graphic1 = CompositeGraphic()
graphic2 = CompositeGraphic()

graphic1.add(ellipse1)
graphic1.add(ellipse2)
graphic1.add(ellipse3)
graphic1.remove(ellipse2)

graphic2.add(ellipse4)

graphic.add(graphic1)
graphic.add(graphic2)

graphic.print()
