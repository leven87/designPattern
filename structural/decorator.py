"""
Decorator pattern example.
"""
from abc import ABC, abstractmethod

NOT_IMPLEMENTED = "You should implement this method."

# Role: Component
class CarSale():
    @abstractmethod
    def displayCarInfo(self):
        raise NotImplementedError(NOT_IMPLEMENTED)


# Role: Concreted Class
class CarInfo(CarSale):
        
    def displayCarInfo(self):
        print("Price: 2000$")
        print("Name: TOYOTA 2020")
        print("Place of production: China")     

#Role: Decorator Component
class  SaleTalk(CarSale):
    def __init__(self,car_sale):
        self._car_sale = car_sale

    #override
    def  displayCarInfo(self):
        self._car_sale.displayCarInfo()


# Role Decorator1
class SpeedDecorator(SaleTalk):
    def __init__(self,car_sale):
        super().__init__(car_sale)

    def __showSpeed(self):
        print("Speed is fast, up to 500km/h")

    def  displayCarInfo(self):
        super().displayCarInfo()
        self.__showSpeed()

# Role Decorator2
class OilDecorator(SaleTalk):
    def __init__(self,car_sale):
        super().__init__(car_sale)

    def __showOil(self):
        print("More fuel-efficient than 90% of cars")

    def  displayCarInfo(self):
        super().displayCarInfo()
        #self.__showOil()


# Role Client
car_info = CarInfo()
#car_info.displayCarInfo()
speed_decorator = SpeedDecorator(car_info)
#speed_decorator.displayCarInfo()
final_decorator = OilDecorator(speed_decorator)
final_decorator.displayCarInfo()
