import RPi.GPIO as GPIO
from time import sleep
GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)

GPIO.setup(37,GPIO.IN)
GPIO.setup(35,GPIO.IN)
GPIO.setup(33,GPIO.IN)
GPIO.setup(31,GPIO.IN)

GPIO.setup(13,GPIO.IN)
GPIO.setup(15,GPIO.IN)

GPIO.setup(7,GPIO.OUT)
GPIO.setup(11,GPIO.OUT)

pwm1=GPIO.PWM(7,50)
pwm2=GPIO.PWM(11,50)
pwm1.start(0)
pwm2.start(0)

def setangle1(angle):
	duty=angle/18+2
	GPIO.output(7,True)
	pwm1.ChangeDutyCycle(duty)
	sleep(1)
	GPIO.output(7,False)
	pwm1.ChangeDutyCycle(0)

def setangle2(angle):
	duty=angle/18+2
	GPIO.output(11,True)
	pwm2.ChangeDutyCycle(duty)
	sleep(1)
	GPIO.output(11,False)
	pwm2.ChangeDutyCycle(0)

while True:
	y1=GPIO.input(15)
	y2=GPIO.input(13)
	
	if(y2==False):
		setangle1(90)
                sleep(1.5)
                setangle1(0)
		
	if(y1==False):
        	x1=GPIO.input(37)
        	x2=GPIO.input(35)
        	x3=GPIO.input(33)
        	x4=GPIO.input(31)
               
        	if(x1==False and x2==False and x3==False and x4==False):
            		sleep(1)
        	else:
            		setangle2(90)
            		sleep(1.5)
            		setangle2(0)
		sleep(1)


pwm1.stop()
pwm2.stop()
GPIO.cleanup()	